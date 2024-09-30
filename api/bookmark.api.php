<?php
require_once '../authmiddleware.php';
require_once '../classes/saved.property.class.php';

// Check if the user is logged in
checkAuth();

$saveobj = new Save();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $saveobj->propertyId = $_POST['propertyId'];

    if ($saveobj->saveProperty()) {
        http_response_code(200);
        echo json_encode(['message' => 'Property saved successfully.']);
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Invalid request method.']);
    }
}