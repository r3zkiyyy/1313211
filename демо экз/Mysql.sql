CREATE DATABASE violations;

USE violations;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE statements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    car_number VARCHAR(20) NOT NULL,
    description TEXT NOT NULL,
    status ENUM('new', 'confirmed', 'rejected') DEFAULT 'new',
    FOREIGN KEY (user_id) REFERENCES users(id)
);
