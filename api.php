<?php

require_once("./classes/autoload.php");
$DB = new Database();

$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);

// Debug: Cetak data yang diterima untuk memastikan
file_put_contents("debug.log", "Received data: " . print_r($DATA_OBJ, true) . "\n", FILE_APPEND);

$Error = "";

// Proses data
if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "signup") {
    //signup data
    include("includes/signup.php");
}