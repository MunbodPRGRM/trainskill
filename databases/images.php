<?php

function uploadCourseImages($course_id, $files) {
    $targetDIR = __DIR__ . "/../public/uploads/";
    $allowTypes = ['jpg', 'jpeg', 'png'];
    $uploadedPaths = [];
    $conn = getConnection();

    foreach ($files as $key => $file) {
        if (!empty($file["name"])) {
            $fileName = time() . "_" . basename($file["name"]);
            $targetFilePath = $targetDIR . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                
                    $uploadedPaths[$key] = $fileName;

                    $imageOrder = array_search($key, array_keys($files)) + 1; // ลำดับรูป (1-4)

                    $stmt = $conn->prepare("INSERT INTO images (course_id, file_name, image_order) VALUES (?, ?, ?)");
                    $stmt->bind_param("isi", $course_id, $fileName, $imageOrder);

                    if (!$stmt->execute()) {
                        
                        error_log("Error inserting image into database: " . $stmt->error);
                    }

                    $stmt->close();
                }
            } else {
                
                error_log("Unsupported file type: " . $fileType);
            }
        }
    }

    return true;
}

function getCourseImageTitle($course_id) {
    $conn = getConnection();  

    $courseQuery = $conn->query("SELECT * FROM courses WHERE course_id = '$course_id'");
    
    if ($courseQuery->num_rows > 0) {
        $course = $courseQuery->fetch_assoc(); 

        $imagesQuery = $conn->query("SELECT * FROM images WHERE course_id = '$course_id' AND image_order = 1");

        // เก็บผลลัพธ์รูปภาพ
        $images = [];
        if ($imagesQuery->num_rows > 0) {
            while ($image = $imagesQuery->fetch_assoc()) {
                $images[] = 'uploads/' . $image['file_name'];  // เก็บ URL ของรูปภาพ
            }
        }

        $conn->close();

        return [
            'course' => $course,
            'images' => $images
        ];
    } else {
        $conn->close();  
        return null;  
    }
}

function getCourseDetails($course_id) {
    $conn = getConnection();

    $courseQuery = $conn->query("SELECT * FROM courses WHERE course_id = '$course_id'");
    
    if ($courseQuery->num_rows > 0) {
        $course = $courseQuery->fetch_assoc();

        // ดึงข้อมูลรูปภาพ โดยเรียงตาม image_order
        $imagesQuery = $conn->query("SELECT * FROM images WHERE course_id = '$course_id' ORDER BY image_order ASC");

        // เก็บรูปภาพตามตำแหน่ง image_order
        $images = array_fill(1, 4, null); // กำหนดค่าเริ่มต้นเป็น null (เผื่อไม่มีภาพในบางตำแหน่ง)
        while ($image = $imagesQuery->fetch_assoc()) {
            $images[$image['image_order']] = 'uploads/' . $image['file_name'];
        }

        $conn->close();

        return [
            'course' => $course,
            'images' => $images
        ];
    } else {
        $conn->close();
        return null;
    }
}

function updateImages($course_id, $files) {
    $targetDIR = __DIR__ . "/../public/uploads/";
    $allowTypes = ['jpg', 'jpeg', 'png'];
    $conn = getConnection();

    $stmt = $conn->prepare("SELECT image_id, file_name, image_order FROM images WHERE course_id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $existingImages = [];

    while ($row = $result->fetch_assoc()) {
        $existingImages[$row['image_order']] = [
            'image_id' => $row['image_id'],
            'file_name' => $row['file_name']
        ];
    }
    $stmt->close();

    foreach ($files as $key => $file) {
        if (!empty($file["name"])) {
            $fileName = time() . "_" . basename($file["name"]);
            $targetFilePath = $targetDIR . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $currentTime = date('Y-m-d H:i:s'); // เวลาปัจจุบัน

            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                    $imageOrder = array_search($key, array_keys($files)) + 1; // ลำดับรูป (1-4)

                    if (isset($existingImages[$imageOrder])) {
                        // อัปเดตรูปภาพใหม่และเวลาที่อัปโหลด
                        $stmt = $conn->prepare("UPDATE images SET file_name = ?, uploaded_on = ? WHERE image_id = ?");
                        $stmt->bind_param("ssi", $fileName, $currentTime, $existingImages[$imageOrder]['image_id']);
                    } else {
                        // แทรกรูปภาพใหม่ถ้ายังไม่มีในลำดับนี้
                        $stmt = $conn->prepare("INSERT INTO images (course_id, file_name, image_order, uploaded_on) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("isis", $course_id, $fileName, $imageOrder, $currentTime);
                    }

                    if (!$stmt->execute()) {
                        error_log("Error updating image in database: " . $stmt->error);
                    }
                    $stmt->close();

                    // ลบไฟล์รูปภาพเก่าจากเซิร์ฟเวอร์
                    if (isset($existingImages[$imageOrder])) {
                        $oldFile = $targetDIR . $existingImages[$imageOrder]['file_name'];
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }
                }
            } else {
                error_log("Unsupported file type: " . $fileType);
            }
        }
    }

    return true;
}

function deleteImage($course_id) {
    $targetDIR = __DIR__ . "/../public/uploads/";
    $conn = getConnection();

    $stmt = $conn->prepare("SELECT file_name FROM images WHERE course_id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $filePath = $targetDIR . $row['file_name'];

        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                echo "ลบไฟล์: " . $filePath . " สำเร็จ<br>";
            } else {
                echo "ไม่สามารถลบไฟล์: " . $filePath . "<br>";
            }
        } else {
            echo "ไฟล์ไม่พบ: " . $filePath . "<br>";
        }
    }

    $stmt->close();

    $deleteStmt = $conn->prepare("DELETE FROM images WHERE course_id = ?");
    $deleteStmt->bind_param("i", $course_id);
    $deleteStmt->execute();
    $deleteStmt->close();
}

function uploadProfileImage($file) {
    $targetDIR = realpath(__DIR__ . "/../public/uploads/") . "/";
    $allowTypes = ['jpg', 'jpeg', 'png', 'gif'];

    $profile_image = null;

    if (!empty($file["name"])) {
        $fileName = time() . "_" . basename($file["name"]);
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileType, $allowTypes)) {
            $targetFilePath = $targetDIR . $fileName;

            if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                return $fileName;
            } else {
                error_log("Error uploading the file.");
            }
        } else {
            error_log("Unsupported file type: " . $fileType);
        }
    }

    return "Unknown_person.jpg"; 
}

function updateProfileImage($file, $user_id) {
    $targetDIR = __DIR__ . "/../public/uploads/";
    $allowedTypes = ['jpg', 'jpeg', 'png'];

    $fileName = time() . "_" . basename($file["name"]);
    $targetFilePath = $targetDIR . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (in_array($fileType, $allowedTypes)) {
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT profile_image FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $oldFile = $targetDIR . $row['profile_image'];
        $stmt->close();

        if (!empty($row['profile_image']) && file_exists($oldFile)) {
            if (!unlink($oldFile)) {
                error_log("Failed to delete old profile image: " . $oldFile);
            }
        }

        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            return $fileName; 
        } else {
            $_SESSION['error'] = 'การอัปโหลดรูปภาพล้มเหลว';
            return false;
        }
    } else {
        $_SESSION['error'] = 'ไฟล์ไม่รองรับ';
        return false;
    }
}