CREATE DATABASE feedback_system;

USE feedback_system;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type ENUM('student', 'admin') NOT NULL,
    branch VARCHAR(50),
    section VARCHAR(10)
);

CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    subject VARCHAR(100) NOT NULL,
    clarity INT NOT NULL,
    engagement INT NOT NULL,
    instructor INT NOT NULL,
    resources INT NOT NULL,
    overall INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);