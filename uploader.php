<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['userid'])) {
    http_response_code(401);
    echo json_encode(['message' => 'Unauthorized', 'data_type' => 'error']);
    die;
}

// Logging awal
file_put_contents("debug.log", "Uploader accessed\n", FILE_APPEND);

// Autoload class
require_once("classes/autoload.php");
$DB = new Database();

$data_type = isset($_POST['data_type']) ? $_POST['data_type'] : "";
$info = (object) [];
$destination = "";

// Validasi file
if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {
    if ($_FILES['file']['error'] == 0) {
        // Validasi tipe file
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['file']['type'], $allowed_types)) {
            $info->message = "Invalid file type. Only JPEG, PNG, and GIF are allowed.";
            $info->data_type = $data_type;
            echo json_encode($info);
            die;
        }

        // Validasi ukuran file
        $max_file_size = 5 * 1024 * 1024; // 5MB
        if ($_FILES['file']['size'] > $max_file_size) {
            $info->message = "File size exceeds the maximum limit of 5MB.";
            $info->data_type = $data_type;
            echo json_encode($info);
            die;
        }

        // Pastikan folder upload ada
        $folder = "uploads/";
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Tentukan lokasi tujuan file
        $destination = $folder . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
            $info->message = "Your image uploaded successfully.";
            $info->data_type = $data_type;
            $info->file_path = $destination; // Untuk debugging
            echo json_encode($info);
        } else {
            $info->message = "Failed to upload the file.";
            $info->data_type = $data_type;
            echo json_encode($info);
            die;
        }
    } else {
        $info->message = "File upload error: " . $_FILES['file']['error'];
        $info->data_type = $data_type;
        echo json_encode($info);
        die;
    }
} else {
    $info->message = "No file uploaded.";
    $info->data_type = $data_type;
    echo json_encode($info);
    die;
}