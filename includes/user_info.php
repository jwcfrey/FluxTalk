<?php

$info = (Object)[];
$data = false;

// Validate info
$data['userid'] = $_SESSION['userid'];

if ($Error == "") {
    $query = "SELECT * FROM users WHERE userid = :userid LIMIT 1";
    $result = $DB->read($query, $data);

    if (is_array($result)) {
        $result = $result[0];
        $result->data_type = "user_info";

        // Set default image based on gender
        $image = ($result->gender == "Male") ? "./assets/ui/images/malenoprofile.png" : "./assets/ui/images/femalenoprofile.png";

        // Check if user image exists
        if (!empty($result->image) && file_exists($result->image)) {
            $image = $result->image;
        }

        $result->image = $image;
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
