<?php

if (isset($DATA_OBJ->find->userid)) {
    $userid = $DATA_OBJ->find->userid;

    // Pastikan $userid digunakan dalam query
    $sql = "SELECT * FROM users WHERE userid = :userid LIMIT 1";
    $arr['userid'] = $userid;

    $result = $DB->read($sql, $arr);
    if (is_array($result)) {
        // User ditemukan
        $row = $result[0];
        $image = ($row->gender == "Male") ? "./assets/ui/images/malenoprofile.png" : "./assets/ui/images/femalenoprofile.png";
        if (file_exists($row->image)) {
            $image = $row->image;

            $mydata = "
                <link rel='stylesheet' href='/assets/css/index.css'>
                Now Chatting with<br>
                <div id='active_contact'>
                    <img src='$image'>
                    <br>$row->username
                </div>";
            $info->message = $mydata;
            $info->data_type = "chats";
            echo json_encode($info);
        } else {
            // User tidak ditemukan
            $info = new stdClass();
            $info->message = "That contact was not found";
            $info->data_type = "error";
            echo json_encode($info);
        }
    } else {
        // Jika `userid` tidak ditemukan dalam request
        $info = new stdClass();
        $info->message = "Invalid user ID.";
        $info->data_type = "error";
        echo json_encode($info);
    }
}

?>
