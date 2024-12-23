<?php

$sql = "SELECT * FROM users limit 10";
$myusers = $DB->read($sql, []);

$mydata = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Caveat+Brush&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Roboto+Slab:wght@100..900&display=swap");

        #wrapper {
            max-width: 900px;
            min-height: 500px;
            display: flex;
            margin: auto;
            color: white;
            font-family: "Roboto Slab", serif;
            font-size: 13px;
        }

        #left_pannel {
            min-height: 500px;
            min-width: 100px;
            background-color: #27344b;
            flex: 1;
            text-align: center;
        }

        #left_pannel_image {
            padding: 10px;
        }

        // #profile_image {
        //     width: 50%;
        //     border: solid thin white;
        //     border-radius: 50%;
        //     margin: 10px;
        // }

        #left_pannel label {
            width: 94.2%;
            height: 21px;
            display: block;
            background-color: #404b56;
            border-bottom: solid thin #ffffff55;
            cursor: pointer;
            padding: 5px;
            transition: all 1s ease;
        }

        #left_pannel label:hover {
            background-color: #778593;
        }

        #left_pannel label img {
            float: left;
            width: 25px;
        }

        .wrapper-span {
            font-size: 12px;
            opacity: 0.5;
        }

        #right_pannel {
            min-height: 500px;
            flex: 4;
            text-align: center;
        }

        #header {
            background-color: #485b6c;
            height: 70px;
            font-size: 30px;
            text-align: center;
            font-family: "Caveat Brush", serif;
            font-weight: 400;
            font-style: normal;
            position: relative;
        }

        #container {
            display: flex;
        }

        #inner_left_pannel {
            background-color: #383e48;
            flex: 1;
            min-height: 430px;
        }

        #inner_right_pannel {
            background-color: #f2f7f8;
            flex: 2;
            min-height: 430px;
            transition: all 1s ease;
        }

        #radio_contacts:checked ~ #inner_right_pannel,
        #radio_settings:checked ~ #inner_right_pannel {
            flex: 0;
        }

        .radio_all_chat {
            display: none;
        }

        #logout_btn {
            float: left;
            width: 23px;
            font-size: 20px;
        }

        #contact {
            width: 100px;
            height: 120px;
            margin: 10px;
            display: inline-block;
            vertical-align: top;
        }

        #contact img {
            width: 100px;
            height: 100px;
        }

        .loader_on {
            position: absolute;
            width: 30%;
        }

        .loader_off {
            display: none;
        }

        /* contacts */
        @keyframes appearance {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }

            100% {
                opacity: 1;
                transform: translateY(0px);
            }
        }

        .image_contact {
            animation: appearance 0.7s ease-in-out;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="image_contact">';
        if (is_array($myusers)) {
            foreach ($myusers as $row) {
                $image = ($row->gender == "Male") ? "./assets/ui/images/malenoprofile.png" : "./assets/ui/images/femalenoprofile.png";
                if (file_exists($row->image)) {
                    $image = $row->image;
                }

                $mydata .= "
                <div id='contact'>
                    <img src='$image' alt='contact' loading='lazy'>
                    <br>$row->username
                </div>";
            }
        }
$mydata .= '
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".image_contact").classList.add("loaded");
        });
    </script>
</body>
</html>';

$info->message = $mydata;
$info->data_type = "contacts";
echo json_encode($info);

die;

$info->message = "No contacts were found";
$info->data_type = "error";
echo json_encode($info);
?>
