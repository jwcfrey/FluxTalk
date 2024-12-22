<?php

$info = (Object) [];
$data = false;

// Validate info
$data['userid'] = $_SESSION['userid'];

if ($Error == "") {
    $query = "SELECT * FROM users WHERE userid = :userid LIMIT 1";
    $result = $DB->read($query, $data);

    if (is_array($result)) {
        $result = $result[0];
        $result->data_type = "user_info";
        echo json_encode($result);
    } else {
        $info->message = "No account found with this email.";
        $info->data_type = "error";
        echo json_encode($info);

    }
} else {
    $info->message = $Error;
    $info->data_type = "error";
    echo json_encode($info);
}