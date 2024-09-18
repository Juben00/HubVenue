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
    property_name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    image BLOB NOT NULL,
    amenities LONGTEXT NOT NULL,
    price DOUBLE NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
);

-- Create the payment table with a foreign key constraint
CREATE TABLE payments (
    pay_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    amount DOUBLE NOT NULL,
    payment_method VARCHAR(255) NOT NULL,
    payment_info VARCHAR(255) NOT NULL
);

-- Create the bookings table with a foreign key constraint
CREATE TABLE bookings (
    b_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    userId INT(11) NOT NULL,
    propertyId INT(11) NOT NULL,
    day INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    check_in TIME NULL,
    check_out TIME NULL,
    paymentId INT(11) NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (propertyId) REFERENCES properties(p_id) ON DELETE CASCADE,
    FOREIGN KEY (paymentId) REFERENCES payments(pay_id) ON DELETE CASCADE
);

CREATE TABLE saved_properties (
    sp_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    userId INT(11) NOT NULL,
    propertyId INT(11) NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (propertyId) REFERENCES properties(p_id) ON DELETE CASCADE
);



-- SELECT u.usertype, u.username, b.*, p.* FROM users u JOIN bookings b ON u.id = b.userId JOIN payments p ON b.b_id = p.b_id WHERE u.id = 130