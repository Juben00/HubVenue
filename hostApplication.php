<?php
require_once './authmiddleware.php';
require_once './api/imageUpload.api.php';
require_once './classes/user.class.php';
$settings = require_once './Settings.php';

// Check if the user is logged in
checkAuth();

$userobj = new User();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming these POST variables exist in the form
    $userobj->transaction_method = $_POST['transaction_method'];
    $userobj->transaction_details = $_POST['transaction_details'];
    $userobj->identification_card = $_POST['identification_card'];

    // Handle file upload
    if (isset($_FILES['identification_card_image']) && $_FILES['identification_card_image']['error'] === UPLOAD_ERR_OK) {
        $userobj->identification_card_image_url = uploadImage($_FILES['identification_card_image']);
    } else {
        $userobj->identification_card_image_url = null;
    }

    // Register user and handle the result
    if ($userobj->hostApplication()) {
        $settings->message = "Registration successful!";
    } else {
        $settings->message = "Registration failed!";
    }
}
