-- Create the database
CREATE DATABASE IF NOT EXISTS attendance_system;

-- Use the database
USE attendance_system;

-- Create students table
CREATE TABLE IF NOT EXISTS students (
    prn VARCHAR(20) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    roll_no VARCHAR(20) NOT NULL UNIQUE,
    year INT NOT NULL,
    course VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample data
INSERT INTO students (prn, name, roll_no, year, course, password) VALUES
('1032232229', 'Ayush Kadali', '54', 2, 'B.Tech. CSE', 'Password@123'), -- password: 'password123'
('1032232197', 'Krishna Khandelwal', '42', 2, 'B.Tech. CSE', 'whoamI@42');
