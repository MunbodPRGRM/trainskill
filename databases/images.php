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

        $imagesQuery = $conn->query("SELECT * FROM images WHERE course_id = '$course_id'");

        $images = [];
        if ($imagesQuery->num_rows > 0) {
            while ($image = $imagesQuery->fetch_assoc()) {
                $images[] = 'uploads/' . $image['file_name'];  
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