<?php

require_once 'vendor/autoload.php';
use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

function uploadImage($file)
{
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

    $uploadedFile = $file['tmp_name'];

    try {
        $uploadResult = (new UploadApi())->upload($uploadedFile, [
            'folder' => 'identification_cards',
            'public_id' => 'user_' . uniqid(),
        ]);

        return $uploadResult['secure_url'];

    } catch (Exception $e) {
        // Return the error message instead of success URL
        return "Upload failed: " . $e->getMessage();
    }
}
