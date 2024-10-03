CREATE DATABASE Hubvenue;

USE Hubvenue;

-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usertype ENUM('client', 'user') NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, 
    profile_pic_url VARCHAR(255),
    transaction_method VARCHAR(255),
    transaction_details VARCHAR(255),
    identification_card VARCHAR(255),
    identification_card_image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    token VARCHAR(255),
    expires_at DATETIME
);

-- Create the properties table with a foreign key constraint
CREATE TABLE properties (
    p_id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT NOT NULL,
    property_name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,  -- Changed to store image URL
    amenities LONGTEXT NOT NULL,
    price DOUBLE NOT NULL,
    status ENUM('approved', 'pending', 'rejected') DEFAULT 'pending',
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
);

-- Create the payments table with a foreign key constraint
CREATE TABLE payments (
    pay_id INT AUTO_INCREMENT PRIMARY KEY,
    amount DOUBLE NOT NULL,
    payment_method VARCHAR(255) NOT NULL,
    payment_info VARCHAR(255),
    payment_image_url VARCHAR(255),
    payment_status ENUM('paid', 'pending', 'rejected') DEFAULT 'pending',
    userId INT NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
);

-- Create the bookings table with foreign key constraints
CREATE TABLE bookings (
    b_id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT NOT NULL,
    propertyId INT NOT NULL,
    day INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    check_in TIME,
    check_out TIME,
    paymentId INT NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (propertyId) REFERENCES properties(p_id) ON DELETE CASCADE,
    FOREIGN KEY (paymentId) REFERENCES payments(pay_id) ON DELETE CASCADE
);

-- Create the saved properties table with foreign key constraints
CREATE TABLE saved_properties (
    sp_id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT NOT NULL,
    propertyId INT NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (propertyId) REFERENCES properties(p_id) ON DELETE CASCADE
);

CREATE TABLE property_disabled (
    pd_id INT AUTO_INCREMENT PRIMARY KEY,
    propertyId INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    FOREIGN KEY (propertyId) REFERENCES properties(p_id) ON DELETE CASCADE
);

INSERT INTO properties (p_id, userId, property_name, location, description, image, amenities, price, status) VALUES
(1, 2, 'The Residence', 'Ayala, Zamboanga City', 'A contemporary 2-bedroom, 1-bathroom home featuring Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/yh8mqGX/beaach-house-12.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 1500, "pending"),
(2, 2, 'The Kubo House', 'Tumaga, Zamboanga City', 'This charming 2-bedroom, 1-bathroom cottage offers Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/fvtQfcr/beach-house-11.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 2500, "pending"),
(3, 2, 'Modern House', 'Tetuan, Zamboanga City', 'A spacious 3-bedroom, 2-bathroom home with an open Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/V9zWk2K/beach-house-15.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 1500, "pending"),
(4, 2, 'The Camp', 'Lunzuran, Zamboanga City', 'A luxurious 4-bedroom, 3-bathroom townhouse boasting Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/txznhzZ/beach-house-9.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 3000, "pending"),
(5, 2, 'The Goblin', 'Tugbungan, Zamboanga City', 'A beautifully designed 4-bedroom home with spacious Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/CthFt4R/beach-house-2.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 2700, "pending"),
(6, 2, 'House of The Man', 'Sta.Maria, Zamboanga City', 'This cozy 3-bedroom, 2-bathroom bungalow offers a Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/JCbG4Cp/beach-house-3.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 2200, "pending"),
(7, 2, 'Ang Balay', 'San Roque, Zamboanga City', 'Trendy 1-bedroom, 1-bathroom loft with floor-to-ce Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/LkbsxcJ/beach-house-1.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 1500, "pending"),
(8, 2, 'Home of Menggols', 'Calarian, Zamboanga City', 'A stunning 5-bedroom, 3-bathroom home featuring a Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/SsXwXd3/beach-house-13.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 4500, "pending"),
(9, 2, 'The House of Grey', 'Guiwan, Zamboanga City', 'Modern 2-bedroom, 2-bathroom condo with a sleek ki Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/M9CdwLf/beach-house-4.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 3520, "pending");

