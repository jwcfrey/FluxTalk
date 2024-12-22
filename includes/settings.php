<?php
$mydata = 'settings go here';

// $result = $result[0];
$info->message = $mydata;
$info->data_type = "settings";
echo json_encode($info);

die;
