-- สร้างตาราง users
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    gender ENUM('ชาย', 'หญิง', 'ไม่ระบุ'),
    image MEDIUMBLOB,
    birthday DATE,
    phone_number VARCHAR(20)
);

-- สร้างตาราง courses
CREATE TABLE courses (
    course_id INT PRIMARY KEY AUTO_INCREMENT,
    course_name VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    description TEXT,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    image1 MEDIUMBLOB,
    image2 MEDIUMBLOB,
    image3 MEDIUMBLOB,
    image4 MEDIUMBLOB,
    max INT NOT NULL,
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
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    registration_id INT NOT NULL,
    status ENUM('waiting', 'completed', 'cancelled') NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
    FOREIGN KEY (registration_id) REFERENCES registration(registration_id) ON DELETE CASCADE
);

-- เพิ่มข้อมูลในตาราง users
INSERT INTO users (user_name, email, password, gender, image, birthday, phone_number) VALUES
('สมชาย ใจดี', 'somchai@example.com', 'password123', 'ชาย', NULL, '1990-05-10', '0812345678'),
('สมหญิง สายสวย', 'somsri@example.com', 'password456', 'หญิง', NULL, '1992-08-20', '0823456789'),
('ปรีชา นักสู้', 'preecha@example.com', 'password789', 'ชาย', NULL, '1985-12-15', '0834567890'),
('วิภา รักเรียน', 'wipa@example.com', 'passwordabc', 'หญิง', NULL, '1998-04-25', '0845678901'),
('อนุชา ใจดี', 'anucha@example.com', 'passworddef', 'ชาย', NULL, '1995-11-30', '0856789012'),
('กัญญา น่ารัก', 'kanya@example.com', 'passwordghi', 'หญิง', NULL, '2000-06-18', '0867890123'),
('พงษ์ศักดิ์ มั่นคง', 'pongsak@example.com', 'passwordjkl', 'ชาย', NULL, '1988-03-22', '0878901234');

-- เพิ่มข้อมูลในตาราง courses
INSERT INTO courses (course_name, user_id, description, start_date, end_date, image1, image2, image3, image4, max) VALUES
('คอร์สเรียนภาษาอังกฤษ', 1, 'เรียนภาษาอังกฤษเบื้องต้น', '2024-03-01', '2024-04-30', NULL, NULL, NULL, NULL, 30),
('คอร์สเขียนโปรแกรม Python', 2, 'สอนเขียนโปรแกรม Python สำหรับผู้เริ่มต้น', '2024-03-15', '2024-05-15', NULL, NULL, NULL, NULL, 25),
('คอร์สถ่ายภาพ', 3, 'สอนการถ่ายภาพและแต่งรูป', '2024-04-01', '2024-05-31', NULL, NULL, NULL, NULL, 20),
('คอร์สทำอาหารไทย', 4, 'สอนทำอาหารไทยเมนูยอดนิยม', '2024-02-10', '2024-04-10', NULL, NULL, NULL, NULL, 15),
('คอร์สโยคะเพื่อสุขภาพ', 5, 'เรียนโยคะเพื่อสุขภาพที่ดี', '2024-03-20', '2024-06-20', NULL, NULL, NULL, NULL, 20),
('คอร์สลงทุนหุ้น', 6, 'เรียนรู้การลงทุนในหุ้นและการบริหารพอร์ต', '2024-05-01', '2024-07-01', NULL, NULL, NULL, NULL, 25),
('คอร์สสร้างธุรกิจออนไลน์', 7, 'วิธีสร้างธุรกิจออนไลน์ตั้งแต่เริ่มต้น', '2024-04-15', '2024-06-15', NULL, NULL, NULL, NULL, 30);

-- เพิ่มข้อมูลในตาราง registration (การลงทะเบียนเรียน)
INSERT INTO registration (user_id, course_id) VALUES
(1, 1), (2, 1), (3, 2), (4, 3), (5, 4), (6, 5), (7, 6);

-- เพิ่มข้อมูลในตาราง training (การเข้าเรียน)
INSERT INTO training (user_id, course_id, registration_id, status) VALUES
(1, 1, 1, 'waiting'),
(2, 1, 2, 'completed'),
(3, 2, 3, 'waiting'),
(4, 3, 4, 'cancelled'),
(5, 4, 5, 'completed'),
(6, 5, 6, 'waiting'),
(7, 6, 7, 'completed');
