CREATE DATABASE Hubvenue;

USE Hubvenue;

-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usertype VARCHAR(10) NOT NULL,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- Increased length for storing hashed passwords
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the properties table with a foreign key constraint
CREATE TABLE properties (
    p_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    userId INT(11) NOT NULL,
    image BLOB NOT NULL,
    amenities LONGTEXT NOT NULL,
    price DOUBLE NOT NULL,
    booked_date DATE NOT NULL,
    description VARCHAR(255) NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
);
