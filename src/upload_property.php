<?php
require_once './classes/property.class.php';
require_once './sanitize.php';
require_once '../vendor/autoload.php';
use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

session_start();
$localid = $_SESSION['id'] ?? null; // Fetch user ID from session

$propertyObj = new Property();

// Initialize variables for form data and error messages
$userId = $p_name = $location = $description = $image = $amenities = $price = "";
$userIdErr = $p_nameErr = $locationErr = $descriptionErr = $imageErr = $amenitiesErr = $priceErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['property_pic'])) {

    // Sanitize input data
    $userId = $localid;
    $p_name = sanitizeInput($_POST['property_name']);
    $location = sanitizeInput($_POST['property_location']);
    $description = sanitizeInput($_POST['property_description']);

    $amenitiesInput = sanitizeInput($_POST['property_amenities']);
    $amenitiesArray = explode(',', $amenitiesInput);
    $amenitiesAssoc = [];

    foreach ($amenitiesArray as $index => $amenity) {
        $amenityKey = ($index + 1);
        $amenitiesAssoc[$amenityKey] = trim($amenity);
    }

    // Convert the associative array to JSON
    $amenities = json_encode($amenitiesAssoc);

    $price = sanitizeInput($_POST['property_price']);

    // Validate form data
    if (empty($userId)) {
        $userIdErr = "You are not signed in";
    }
    if (empty($p_name)) {
        $p_nameErr = "Property name is required";
    }
    if (empty($location)) {
        $locationErr = "Location is required";
    }
    if (empty($description)) {
        $descriptionErr = "Description is required";
    }
    if (empty($amenities)) {
        $amenitiesErr = "Amenities are required";
    }
    if (empty($price)) {
        $priceErr = "Price is required";
    }

    // Proceed if there are no errors
    if (empty($userIdErr) && empty($p_nameErr) && empty($locationErr) && empty($descriptionErr) && empty($amenitiesErr) && empty($priceErr)) {

        // Cloudinary configuration
        Configuration::instance([
            'cloud' => [
                'cloud_name' => 'ddujkyfzj',
                'api_key' => '897774582825532',
                'api_secret' => 'DC5Y_PbDb6Dvv2hAgHvXGB1STnE',
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        // Get the uploaded file
        $uploadedFile = $_FILES['property_pic']['tmp_name'];

        try {
            // Upload file to Cloudinary
            $uploadResult = (new UploadApi())->upload($uploadedFile, [
                'folder' => 'property_pics',
                'public_id' => 'property_' . uniqid(),
            ]);

            // Get the URL of the uploaded image
            $imageUrl = $uploadResult['secure_url'];
            $image = $imageUrl;

            // Set property object attributes
            $propertyObj->userId = $userId;
            $propertyObj->p_name = $p_name;
            $propertyObj->location = $location;
            $propertyObj->description = $description;
            $propertyObj->image = $image;
            $propertyObj->amenities = $amenities;
            $propertyObj->price = $price;

            // Add property to the database
            if ($propertyObj->addProp()) {
                header('Location: ./dashboard.php'); // Redirect on success
                exit();
            } else {
                echo "Failed to add property";
                exit();
            }

        } catch (Exception $e) {
            // Handle upload failure
            echo "Upload failed: " . $e->getMessage();
            exit();
        }
    }
}
