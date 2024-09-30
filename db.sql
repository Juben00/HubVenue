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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    token VARCHAR(255),
    expires_at DATETIME,
    profile_pic_url VARCHAR(255) NOT NULL
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
    status ENUM('approved', 'pending', 'rejected') DEFAULT 'pending',
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

INSERT INTO properties (p_id, userId, property_name, location, description, image, amenities, price, status) VALUES
(1, 1, 'The Residence', 'Ayala, Zamboanga City', 'A contemporary 2-bedroom, 1-bathroom home featuring Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/yh8mqGX/beaach-house-12.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 1500, "pending"),
(5, 1, 'The Kubo House', 'Tumaga, Zamboanga City', 'This charming 2-bedroom, 1-bathroom cottage offers Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/fvtQfcr/beach-house-11.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 2500, "pending"),
(6, 1, 'Modern House', 'Tetuan, Zamboanga City', 'A spacious 3-bedroom, 2-bathroom home with an open Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/V9zWk2K/beach-house-15.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 1500, "pending"),
(7, 1, 'The Camp', 'Lunzuran, Zamboanga City', 'A luxurious 4-bedroom, 3-bathroom townhouse boasting Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/txznhzZ/beach-house-9.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 3000, "pending"),
(8, 1, 'The Goblin', 'Tugbungan, Zamboanga City', 'A beautifully designed 4-bedroom home with spacious Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/CthFt4R/beach-house-2.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 2700, "pending"),
(9, 1, 'House of The Man', 'Sta.Maria, Zamboanga City', 'This cozy 3-bedroom, 2-bathroom bungalow offers a Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/JCbG4Cp/beach-house-3.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 2200, "pending"),
(10, 1, 'Ang Balay', 'San Roque, Zamboanga City', 'Trendy 1-bedroom, 1-bathroom loft with floor-to-ce Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/LkbsxcJ/beach-house-1.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 1500, "pending"),
(11, 1, 'Home of Menggols', 'Calarian, Zamboanga City', 'A stunning 5-bedroom, 3-bathroom home featuring a Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/SsXwXd3/beach-house-13.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 4500, "pending"),
(12, 1, 'The House of Grey', 'Guiwan, Zamboanga City', 'Modern 2-bedroom, 2-bathroom condo with a sleek ki Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt expedita molestiae natus ea minima vel, molestias quo architecto veniam autem! lorem ipsum dolor, sit amet.', 'https://i.ibb.co/M9CdwLf/beach-house-4.jpg', '{"1": "pool", "2": "basketball court", "3": "karaoke"}', 3520, "pending");

CREATE TABLE properties (
    p_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    userId INT(11) NOT NULL,
    property_name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    image BLOB NOT NULL,
    amenities LONGTEXT NOT NULL,
    price DOUBLE NOT NULL,
    status ENUM('approved', 'pending', 'rejected') DEFAULT 'pending',
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
);


--    // document.getElementById('result').addEventListener('submit', function (e) {
--     //     // Check if the event target is a form with an ID starting with "bookmark-"
--     //     if (e.target && e.target.matches('form[id^="bookmark-"]')) {
--     //         e.preventDefault();

--     //         fetch('./api/bookmark.api.php', {
--     //             method: "POST",
--     //             headers: {
--     //                 'Content-Type': 'application/x-www-form-urlencoded',
--     //             },
--     //             body: new URLSearchParams(new FormData(e.target))
--     //         })
--     //         .then(response => response.text())
--     //         .then(html => {
--     //             console.log('Success:', html);
--     //         })
--     //         .catch((error) => {
--     //             console.error('Error:', error);
--     //         });
--     //     }
--     // });


-- bookmark html
-- <form id="bookmark-<?php echo $property['p_id']; ?>">
--                                             <input type="hidden" name="propertyId" value="<?php echo $property['p_id']; ?>">
--                                             <button type="submit"
--                                                 class="<?php echo in_array($property['p_id'], array_column($filteredProperties, "propertyId")) ? 'text-red-500' : 'text-neutral-100' ?> ">
--                                                 <svg xmlns=" http://www.w3.org/2000/svg" width="25" height="25"
--                                                     fill="currentColor" class="bi bi-bookmark-fill" viewBox="0 0 16 16">
--                                                     <path
--                                                         d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2" />
--                                                 </svg>
--                                             </button>
--                                         </form>
