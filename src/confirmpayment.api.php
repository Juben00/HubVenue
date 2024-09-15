<?php
require_once __DIR__ . '/authmiddleware.php';
require_once __DIR__ . '/classes/property.class.php';
require_once __DIR__ . '/classes/booking.class.php';
require_once __DIR__ . '/sanitize.php';

$property = new Property();

$item = [];

checkAuth(); // Check if the user is logged in


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookingObj = new Booking();

    $bookingObj->userId = sanitizeInput($_SESSION['id']);
    $bookingObj->propertyId = sanitizeInput($item['p_id']);
    $bookingObj->amount = sanitizeInput($item['price']);
    $bookingObj->date = sanitizeInput($_POST['date']);
    $bookingObj->check_in = sanitizeInput($_POST['starttime']);
    $bookingObj->check_out = sanitizeInput($_POST['endtime']);
    $bookingObj->payment_method = sanitizeInput($_POST['payment']);

    if ($bookingObj->book()) {
        echo "Booking successful!";
    } else {
        echo "Booking failed!";
    }
}
