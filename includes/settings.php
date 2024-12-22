<?php

$sql = "SELECT * FROM users WHERE userid = :userid limit 1";
$id = $_SESSION['userid'];
$data = $DB->read($sql, ['userid' => $id]);

$mydata = "";

if(is_array($data)) {
        $data = $data[0];

        //check if image exists
        $image = ($data->gender == "Male") ? "./assets/ui/images/malenoprofile.png" : "./assets/ui/images/femalenoprofile.png";
            if(file_exists($data->image)) {
                $image = $data->image;
            }

        $gender_male = "";
        $gender_female = "";

        if($data->gender == "Male") {
            $gender_male = "checked";
        } else {
            $gender_female = "checked";
        }

        $mydata = '
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>FluxTalk</title>
                <link rel="stylesheet" href="assets/css/settings.css">
            </head>
                    <div id="error">
                        error
                    </div>
                    <div class="myform_first">
                        <div>
                            <img src="'.$image.'" alt="profile_settings" />
                            <input type="button" value="Change Image" id="change_image_button" class="button_signup">
                        </div>
                        <form id="myform">
                            <input type="text" name="username" placeholder="Username" value="'.$data->username.'"><br>
                            <input type="text" name="email" placeholder="Email" value="'.$data->email.'"><br>
                            <div class="gender">
                                Gender: <br>
                                <input type="radio" value="Male" id="gender_male" name="gender" '.$gender_male.'> Male<br>
                                <input type="radio" value="Female" id="gender_female" name="gender" '.$gender_female.'> Female<br>
                            </div>
                            <input type="text" name="password" placeholder="Password" value="'.$data->password.'"><br>
                            <input type="text" name="password2" placeholder="Retype Password" value="'.$data->password.'"><br>
                            <input type="button" value="Save Settings" id="save_settings_button" class="button_signup" onclick="collect_data(event)"><br>
                        </form>
                    </div>
            <script src="./assets/js/index.js"></script>
        ';
}

$info->message = $mydata;
$info->data_type = "settings";
echo json_encode($info);

die;
