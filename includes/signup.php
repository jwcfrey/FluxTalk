<?php

$info = (Object) [];
$data = false;
$data['userid'] = $DB->generate_id(20);
$data['date'] = date("Y-m-d H:i:s");

// Validate username
$data['username'] = trim($DATA_OBJ->username);
if (strlen($data['username']) < 3) {
    $Error .= "Username should be at least 3 characters long.<br>";
}
if (!preg_match("/^[a-zA-Z0-9_]+$/", $data['username'])) {
    $Error .= "Username can only contain letters, numbers, and underscores.<br>";
}

// Validate email
$data['email'] = trim($DATA_OBJ->email);
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $Error .= "Please enter a valid email address.<br>";
}

// Validate gender
$data['gender'] = isset($DATA_OBJ->gender) ? $DATA_OBJ->gender : null;
if(empty($DATA_OBJ->gender)) {
    $Error.= "Please select your gender.<br>";
} else {
    if ($DATA_OBJ->gender != "Male" && $DATA_OBJ->gender != "Female") {
        $Error .= "Please select your valid gender. <br>";
    }
}

// Validate password
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

// If no errors, proceed to save data
if ($Error == "") {
    // Hapus enkripsi password (password_hash) di sini
    // $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT); // Hapus baris ini
    $query = "INSERT INTO users (userid, username, email, gender, password, date) VALUES (:userid, :username, :email, :gender, :password, :date)";
    $result = $DB->write($query, $data);

    if ($result) {
        $info->message = "Your profile was created successfully";
        $info->data_type = "info";
        echo json_encode($info);
    } else {
        $info->message = "Your process was not created due to an error";
        $info->data_type = "error";
        echo json_encode($info);
    }
} else {
    $info->message = $Error;
    $info->data_type = "error";
    echo json_encode($info);
}