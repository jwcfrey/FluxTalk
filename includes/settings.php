<?php

$sql = "SELECT * FROM users WHERE userid = :userid limit 1";
$id = $_SESSION['userid'];
$data = $DB->read($sql, ['userid' => $id]);

$mydata = "";

if (is_array($data)) {
    $data = $data[0];

    //check if image exists
    $image = ($data->gender == "Male") ? "./assets/ui/images/malenoprofile.png" : "./assets/ui/images/femalenoprofile.png";
    if (file_exists($data->image)) {
        $image = $data->image;
    }

    $gender_male = "";
    $gender_female = "";

    if ($data->gender == "Male") {
        $gender_male = "checked";
    } else {
        $gender_female = "checked";
    }

    $mydata = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Settings</title>
            <style>
                @keyframes appearance {
                    0% {
                        opacity: 0;
                        transform: translateY(50px);
                        rotate(50deg);
                        transform-origin: 100% 100%;
                    }
                    100% {
                        opacity: 1;
                        transform: translateY(0px);
                        rotate(0deg);
                        transform-origin: 100% 100%;
                    }
                }

                form {
                    text-align: left;
                    margin: auto;
                    padding: 10px;
                    width: 100%;
                    max-width: 400px;
                }

                .myform_first {
                    display: flex;
                    animation: appearance 0.7s ease;
                    text-align: center;
                }

                .myform_first img {
                    width: 200px; 
                    height: 200px; 
                    margin: 10px;
                }

                #change_image_button {
                    display: inline-block;
                    background-color: #9b9a80;
                    padding: 1em;
                    border-radius: 5px;
                    cursor: pointer;
                }

                #change_image_input {
                    display: none;
                }

                #signup {
                    font-size: 17px;
                    font-family: "Roboto Slab", serif;
                }

                .login_account {
                    display: block;
                    text-align: center;
                    text-decoration: none;
                }

                #error {
                    text-align: center;
                    padding: 0.5em;
                    background-color: #ecaf91;
                    color: white;
                    display: none;
                }

                input[type=text],
                input[type=password] {
                    padding: 10px;
                    margin: 10px;
                    width: 200px;
                    border-radius: 5px;
                    border: solid 1px grey;
                }

                input[type=button] {
                    margin: 10px;
                    border-radius: 5px;
                    border: solid 1px grey;
                    width: 221px;
                    height: 35px;
                    cursor: pointer;
                    background-color: #2b5488;
                    color: white;
                }

                input[type=radio] {
                    transform: scale(1.2);
                    cursor: pointer;
                }

                .gender {
                    padding: 10px;
                }

                .dragging {
                    border: dashed 2px #aaa;
                }
            </style>
        </head>
        <body>
            <div id="error"></div>
            <div class="myform_first">
                <div>
                <span style="font-size: 11px;">drag and drop an image to change</span><br>
                    <img ondragover="handle_drag_and_drop(event)" ondrop="handle_drag_and_drop(event)" ondragleave="handle_drag_and_drop(event)" src="' . $image . '" alt="profile_settings">
                    <label for="change_image_input" id="change_image_button" style="display: inline-block;">
                        Change Image
                    </label>
                        <input type="file" onchange="upload_profile_image(this.files)" id="change_image_input" value="Change Image" class="button_signup">
                </div>
                <form id="myform">
                    <input type="text" name="username" placeholder="Username" value="' . $data->username . '"><br>
                    <input type="text" name="email" placeholder="Email" value="' . $data->email . '"><br>
                    <div class="gender">
                        Gender: <br>
                        <input type="radio" value="Male" id="gender_male" name="gender" ' . $gender_male . '> Male<br>
                        <input type="radio" value="Female" id="gender_female" name="gender" ' . $gender_female . '> Female<br>
                    </div>
                    <input type="text" name="password" placeholder="Password" value="' . $data->password . '"><br>
                    <input type="text" name="password2" placeholder="Retype Password" value="' . $data->password . '"><br>
                    <input type="button" value="Save Settings" id="save_settings_button" class="button_signup" onclick="collect_data(event)"><br>
                </form>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    document.querySelector(".myform_first").classList.add("loaded");
                });
            </script>
            <script src="/assets/js/index.js"></script>
        </body>
        </html>
    ';

$info->message = $mydata;
$info->data_type = "contacts";
echo json_encode($info);

} else {
    $info -> message = "No contacts were found";
    $info -> data_type = "error";
    echo json_encode($info);
}
?>