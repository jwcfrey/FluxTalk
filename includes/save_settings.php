<?php

$info = (Object) [];
$Error = ""; // Inisialisasi variabel error

$data = false;

// Pastikan session memiliki `userid`
if (!isset($_SESSION['userid'])) {
    $info->message = "User not logged in.";
    $info->data_type = "error";
    echo json_encode($info);
    die;
}

$data['userid'] = $_SESSION['userid'];

// Debug log untuk memeriksa data yang diterima
file_put_contents("debug.log", print_r($DATA_OBJ, true), FILE_APPEND);

// Validasi username
$data['username'] = trim($DATA_OBJ->username);
if (strlen($data['username']) < 3) {
    $Error .= "Username should be at least 3 characters long.<br>";
}
if (!preg_match("/^[a-zA-Z0-9_]+$/", $data['username'])) {
    $Error .= "Username can only contain letters, numbers, and underscores.<br>";
}

// Validasi email
$data['email'] = trim($DATA_OBJ->email);
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $Error .= "Please enter a valid email address.<br>";
}

// Validasi gender
$data['gender'] = isset($DATA_OBJ->gender) ? $DATA_OBJ->gender : null;
if (empty($data['gender'])) {
    $Error .= "Please select your gender.<br>";
} elseif ($data['gender'] != "Male" && $data['gender'] != "Female") {
    $Error .= "Please select a valid gender.<br>";
}

// Validasi password
$data['password'] = $DATA_OBJ->password;
$password2 = $DATA_OBJ->password2;
if (strlen($data['password']) < 8) {
    $Error .= "Password should be at least 8 characters long.<br>";
}
if (!preg_match("/[A-Z]/", $data['password']) || !preg_match("/[a-z]/", $data['password']) || !preg_match("/[0-9]/", $data['password']) || !preg_match("/[^a-zA-Z0-9]/", $data['password'])) {
    $Error .= "Password must include at least one uppercase letter, one lowercase letter, one number, and one special character.<br>";
}
if ($data['password'] !== $password2) {
    $Error .= "Passwords do not match.<br>";
}

// Jika tidak ada error, simpan data
if ($Error == "") {
    // Log data untuk debugging
    file_put_contents("debug.log", "Validated data: " . print_r($data, true), FILE_APPEND);

    // Simpan data ke database
    $query = "UPDATE users SET username = :username, email = :email, gender = :gender, password = :password WHERE userid = :userid LIMIT 1";
    $result = $DB->write($query, $data);

    if ($result) {
        $info->message = "Your data was saved successfully.";
        $info->data_type = "save_settings";
        echo json_encode($info);
    } else {
        $info->message = "Your data was not saved due to an error.";
        $info->data_type = "save_settings";
        echo json_encode($info);
    }
} else {
    $info->message = $Error;
    $info->data_type = "save_settings";
    echo json_encode($info);
}