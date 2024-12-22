<?php
$mydata = '
    <div class="image_contact">
    <div id="contact">
        <img src="./assets/ui/images/user1.png" alt="contact1" loading="lazy">
        <br> Username
    </div>
    <div id="contact">
        <img src="./assets/ui/images/user2.jpg" alt="contact1" loading="lazy">
        <br> Username
    </div>
    <div id="contact">
        <img src="./assets/ui/images/user3.jpg" alt="contact1" loading="lazy">
        <br> Username
    </div>
</div>';

// $result = $result[0];
$info->message = $mydata;
$info->data_type = "contacts";
echo json_encode($info);

die;

$info->message = "No contacts were found";
$info->data_type = "error";
echo json_encode($info);
?>