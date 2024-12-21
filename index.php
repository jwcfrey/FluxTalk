<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FluxTalk</title>
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
    <div id="wrapper">
        <div id="left_pannel">
            <div id="left_pannel_image">
                <img id="profile_image" src="./assets/ui/images/user1.jpg" alt="">
                <br>
                Sigma
                <br>
                <span class="wrapper-span">Sigma@gmail.com</span>
                <br><br><br>
                <div>
                    <label id="label_chat" for="radio_chat">Chat
                        <img src="./assets/ui/icons/chat.png" alt="">
                    </label>
                    <label id="label_contacts" for="radio_contacts">Contacts
                        <img src="./assets/ui/icons/contacts.png" alt="">
                    </label>
                    <label id="label_settings" for="radio_settings">Settings
                        <img src="./assets/ui/icons/settings.png" alt="">
                    </label>
                </div>
            </div>
        </div>
        <div id="right_pannel">
            <div id="header">
                FluxTalk
            </div>
            <div id="container">
                <div id="inner_left_pannel">

                </div>
                <input type="radio" id="radio_chat" name="myradio" class="radio_all_chat">
                <input type="radio" id="radio_contacts" name="myradio" class="radio_all_chat">
                <input type="radio" id="radio_settings" name="myradio" class="radio_all_chat">
                <div id="inner_right_pannel">
                    
                </div>
            </div>
        </div>
    </div>
</body>

</html>