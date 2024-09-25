<?php

require_once './dbconnection.php';
require_once '../vendor/autoload.php';
use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

$localid = $_SESSION['id'];
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_pic'])) {
    $cloudinary = new Cloudinary([
        'cloud' => [
            'cloud_name' => 'ddujkyfzj',
            'api_key' => '897774582825532',
            'api_secret' => 'DC5Y_PbDb6Dvv2hAgHvXGB1STnE',
        ],
    ]);

    $uploadedFile = $_FILES['profile_pic']['tmp_name'];

    try {
        $uploadResult = (new UploadApi())->upload($uploadedFile, [
            'folder' => 'profile_pics',      // Optional: specify folder in Cloudinary
            'public_id' => 'user_' . uniqid(), // Unique public ID for the image
        ]);

        // Get the URL of the uploaded image
        $imageUrl = $uploadResult['secure_url'];

        $conn = $db->connect();
        $stmt = $conn->prepare("ALTER TABLE users SET profile_pic_url = :imageUrl WHERE id = :localid;");
        $stmt->bindParam(":imageUrl", $imageUrl);
        $stmt->bindParam(":localid", $localid);

        if ($stmt->execute()) {
            echo "Profile picture uploaded successfully!<br>";
            echo "Image URL: " . $imageUrl . "<br>";
        } else {
            echo "Failed to insert image URL into database.";
        }

    } catch (Exception $e) {
        echo "Upload failed: " . $e->getMessage();
    }
}