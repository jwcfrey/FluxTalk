<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FluxTalK</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="wrapper">
        <div id="left_pannel">
            <div id="left_pannel_image user_info">
                <iframe src="https://giphy.com/embed/c0xcPudJy1JDy" width="100" height="100" frameBorder="0"
                    class="giphy-embed" allowFullScreen></iframe>
                <p><a href="https://giphy.com/stickers/anime-gif-c0xcPudJy1JDy"></a></p>
                <span id="username">Loading..</span>
                <br>
                <span id="email" class="wrapper-span">Loading..</span>
                <br><br><br>
                <div>
                    <label id="label_chats" for="radio_chat">Chats
                        <img src="./assets/ui/icons/chat.png" alt="">
                    </label>
                    <label id="label_contacts" for="radio_contacts">Contacts
                        <img src="./assets/ui/icons/contacts.png" alt="">
                    </label>
                    <label id="label_settings" for="radio_settings">Settings
                        <img src="./assets/ui/icons/settings.png" alt="">
                    </label>
                    <label id="logout" for="radio_logout">
                        Logout
                        <i class="fa fa-sign-out" aria-hidden="true" id="logout_btn"></i>
                    </label>
                </div>
            </div>
        </div>
        <div id="right_pannel">
            <div id="header">
                <div id="loader_holder" class="loader_on">
                    <img src="./assets/ui/icons/giphy.gif" style="width: 70px;" alt="loading">
                </div>
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

<script src="./assets/js/index.js"></script>