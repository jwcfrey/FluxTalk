<?php
$mydata = 'chat go here';

// $result = $result[0];
$info->message = $mydata;
$info->data_type = "chat";
echo json_encode($info);

die;
