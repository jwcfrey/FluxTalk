<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FluxTalk</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div id="wrapper">
        <div id="header">
            FluxTalk
            <div id="signup">
                Login
            </div>
        </div>
        <div id="error">
            
        </div>
        <form id="myform">
            <input type="text" name="email" placeholder="Email"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="submit" value="Login" id="login_button" class="login_button"><br>
            <br>
            <a href="signup.php" id="signup_have">
                Dont Have An Account? Signup here
            </a>
        </form>
    </div>
</body>

</html>

<script src="./assets/js/login.js"></script>