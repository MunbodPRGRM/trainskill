CREATE TABLE images (
    image_id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    image_order TINYINT NOT NULL, -- ลำดับของรูป (1-4)
    uploaded_on DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
);

-- สร้างมาเพื่อเก็บรูป --
