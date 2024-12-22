<?php

$mydata = 'chats go here';

// $result = $result[0];
$info = new stdClass();
$info->message = $mydata;
$info->data_type = "chats";
echo json_encode($info);

die;