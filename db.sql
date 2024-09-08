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
    booked_date DATE NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
);

{"1": "pool", "2": "basketball court", "3": "karaoke"}


<div class="properties-list">
        <?php if (!empty($properties)): ?>
            <?php foreach ($properties as $property): ?>
                <div class="property-item">
                    <h2><?php echo htmlspecialchars($property['property_name']); ?></h2>
                    <p><?php echo htmlspecialchars($property['location']); ?></p>
                    <p><?php echo htmlspecialchars($property['description']); ?></p>
                    <p>Price: <?php echo htmlspecialchars($property['price']); ?></p>
                    <p>Booked Date: <?php echo htmlspecialchars($property['booked_date']); ?></p>
                    <img src="<?php echo htmlspecialchars($property['image']); ?>" alt="Property Image">
                    <div class="amenities">
                        <strong>Amenities:</strong>
                        <?php
                        // Decode JSON amenities
                        $amenities = json_decode($property['amenities'], true);
                        if (is_array($amenities)) {
                            echo '<ul>';
                            foreach ($amenities as $key => $value) {
                                echo '<li>' . htmlspecialchars($value) . '</li>';
                            }
                            echo '</ul>';
                        } else {
                            echo '<p>No amenities listed.</p>';
                        }
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No properties found.</p>
        <?php endif; ?>
    </div>