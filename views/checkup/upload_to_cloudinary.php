<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Include Cloudinary autoload
require __DIR__ . '/../../vendor/autoload.php';

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

// Configure Cloudinary
Configuration::instance([
    'cloud' => [
        'cloud_name' => 'dy9bzsux3',
        'api_key'    => '121194676628732',
        'api_secret' => 'DEqYgUH86qGwo2myI8VFpqFamoI'
    ],
    'url' => ['secure' => true]
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ✅ دڵنیابە لە فایل نێردراوە
    if (!isset($_FILES['file'])) {
        echo json_encode(['success' => false, 'error' => 'هیچ فایلێک نەنێردراوە!']);
        exit;
    }

    $tmpFilePath = $_FILES['file']['tmp_name'];

    // Set folder path based on date
    $year  = date('Y');
    $month = date('m');
    $day   = date('d');
    $folderPath = "checkup/$year/$month/$day";

    // ✅ دروستکردنی ناوی تایبەتی بۆ فایلەکە (تکرار نەبێت)
    $timestamp = time();
    $uniqueName = 'file_' . $timestamp . '_' . uniqid();

    // ✅ بارکردنی فایل بۆ Cloudinary
    try {
        $uploadResult = (new UploadApi())->upload($tmpFilePath, [
            'folder'     => $folderPath,
            'public_id'  => $uniqueName,  // Unique file name
            'overwrite'  => true,         // Overwrite if exists
            'resource_type' => 'image'
        ]);

        if (!empty($uploadResult['secure_url']) && filter_var($uploadResult['secure_url'], FILTER_VALIDATE_URL)) {
            $formattedUrl = htmlspecialchars($uploadResult['secure_url'], ENT_QUOTES, 'UTF-8'); // Properly format the URL
            echo json_encode([
                'success' => true,
                'url'     => $formattedUrl, // Return formatted URL
                'folder'  => $folderPath,
                'name'    => $uniqueName
            ]);
        } else {
            throw new Exception("Invalid URL returned from Cloudinary.");
        }
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'error'   => $e->getMessage()
        ]);
    }

} else {
    echo json_encode([
        'success' => false,
        'error'   => 'Invalid request method!'
    ]);
}