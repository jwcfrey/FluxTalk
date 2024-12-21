<?php 

require_once("./classes/autoload.php");
$DB = new Database();

$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);

// Debug: Cetak data yang diterima untuk memastikan
file_put_contents("debug.log", "Received data: " . print_r($DATA_OBJ, true) . "\n", FILE_APPEND);

// Proses data
if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "signup") {
    // Validasi data input
    if (!empty($DATA_OBJ->username) && !empty($DATA_OBJ->email) && !empty($DATA_OBJ->password)) {
        $data = [];
        $data['userid'] = $DB->generate_id(20);
        $data['username'] = $DATA_OBJ->username;
        $data['email'] = $DATA_OBJ->email;
        $data['password'] = $DATA_OBJ->password;
        $data['date'] = date("Y-m-d H:i:s");

        $query = "INSERT INTO users (userid, username, email, password, date) VALUES (:userid, :username, :email, :password, :date)";
        $result = $DB->write($query, $data);

        if ($result) {
            echo "Your Profile Was Created";
        } else {
            echo "Your Profile Was Not Created";
        }
    } else {
        echo "Please fill in all required fields (username, email, password).";
    }
} else {
    echo "Invalid data type or missing parameters.";
}