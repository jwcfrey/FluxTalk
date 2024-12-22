<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);

$info = (object) [];

if (!isset($_SESSION['userid'])) {
    if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type != "login" && $DATA_OBJ->data_type != "signup") {
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }
}

require_once("./classes/autoload.php");
$DB = new Database();

file_put_contents("debug.log", "Received data: " . print_r($DATA_OBJ, true) . "\n", FILE_APPEND);

$Error = "";

if (isset($DATA_OBJ->data_type)) {
    switch ($DATA_OBJ->data_type) {
        case "signup":
            include("includes/signup.php");
            break;
        case "login":
            include("includes/login.php");
            break;
        case "logout":
            // Hapus sesi untuk logout
            session_unset();
            session_destroy();
            $info->message = "Successfully logged out.";
            $info->data_type = "logout";
            echo json_encode($info);
            break;
        case "user_info":
            if (isset($_SESSION['userid'])) {
                $data['userid'] = $_SESSION['userid'];

                $query = "SELECT username, email FROM users WHERE userid = :userid LIMIT 1";
                $result = $DB->read($query, $data);

                if (is_array($result)) {
                    $result = $result[0];
                    $result->data_type = "user_info";
                    echo json_encode($result);
                } else {
                    $info->message = "No account found with this user ID.";
                    $info->data_type = "error";
                    echo json_encode($info);
                }
            } else {
                $info->message = "User not logged in.";
                $info->data_type = "error";
                echo json_encode($info);
            }
            break;
        default:
            $info->message = "Invalid request type.";
            $info->data_type = "error";
            echo json_encode($info);
    }
} else {
    $info->message = "Invalid input.";
    $info->data_type = "error";
    echo json_encode($info);
}