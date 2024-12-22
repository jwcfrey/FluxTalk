<?php
session_start();

$info = (object)[];
//check if logged in
if(!isset($_SESSION['userid'])) {
    $info->logged_in = false;
    echo json_encode($info);
    die;
}

require_once("./classes/autoload.php");
$DB = new Database();

$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);

file_put_contents("debug.log", "Received data: " . print_r($DATA_OBJ, true) . "\n", FILE_APPEND);

$Error = "";

// Proses data
if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "signup") {
    //signup data
    include("includes/signup.php");
} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "user_info") {
    
}