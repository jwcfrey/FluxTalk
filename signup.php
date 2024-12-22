<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FluxTalk</title>
    <link rel="stylesheet" href="assets/css/signup.css"/>
</head>

<body>
    <div id="wrapper">
        <div id="header">
            FluxTalk
            <div id="signup">
                Sign up
            </div>
        </div>
        <div id="error">

        </div>
        <form id="myform">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="text" name="email" placeholder="Email"><br>
            <div class="gender">
                Gender: <br>
                <input type="radio" value="Male" name="gender"> Male<br>
                <input type="radio" value="Female" name="gender"> Female<br>
            </div>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="password" name="password2" placeholder="Retype Password"><br>
            <input type="button" value="Sign up" id="signup_button" class="button_signup"><br>
        </form>
    </div>
</body>

</html>

<script src="./assets/js/signup.js"></script>