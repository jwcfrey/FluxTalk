<?php

$info = (Object) [];
$data = false;

// Validate info
$data['email'] = trim($DATA_OBJ->email);

if (empty($DATA_OBJ->email)) {
    $Error .= "Please enter a valid email address.<br>";
}
if (empty($DATA_OBJ->password)) {
    $Error .= "Please enter a valid password.<br>";
}

// If no errors, proceed to save data
if ($Error == "") {
    $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $result = $DB->read($query, $data);

    if (is_array($result)) {
        $result = $result[0];

        // Bandingkan password langsung tanpa menggunakan password_verify()
        if ($DATA_OBJ->password === $result->password) {
            // Jika password cocok, simpan ID pengguna di session
            $_SESSION['userid'] = $result->userid;
            $info->message = "You're logged in successfully";
            $info->data_type = "info";
            echo json_encode($info);
        } else {
            // Jika password tidak cocok
            $info->message = "Incorrect email or password. Please try again.";
            $info->data_type = "error";
            echo json_encode($info);
        }
    } else {
        // Jika email tidak ditemukan
        $info->message = "No account found with this email.";
        $info->data_type = "error";
        echo json_encode($info);
    }
} else {
    $info->message = $Error;
    $info->data_type = "error";
    echo json_encode($info);
}