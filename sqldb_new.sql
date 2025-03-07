CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    gender ENUM('male', 'female', 'unknown') DEFAULT 'unknown',
    birthday DATE,
    phone_number VARCHAR(20),
    profile_image VARCHAR(255) NOT NULL  -- เก็บ path ของรูปภาพ
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- สร้างตาราง courses
CREATE TABLE courses (
    course_id INT PRIMARY KEY AUTO_INCREMENT,
    course_name VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    description TEXT,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    max_participants INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- สร้างตาราง registration (การลงทะเบียนเรียน)
CREATE TABLE registration (
    registration_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
);

-- สร้างตาราง training (การเข้าเรียน)
CREATE TABLE training (
    training_id INT PRIMARY KEY AUTO_INCREMENT,
    registration_id INT NOT NULL,
    status ENUM('waiting', 'accepted', 'cancelled') NOT NULL DEFAULT 'waiting',
    attendance ENUM('unknown', 'present', 'absent') DEFAULT 'unknown',
    FOREIGN KEY (registration_id) REFERENCES registration(registration_id) ON DELETE CASCADE
);

CREATE TABLE images (
    image_id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    image_order TINYINT NOT NULL, -- ลำดับของรูป (1-4)
    uploaded_on DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
