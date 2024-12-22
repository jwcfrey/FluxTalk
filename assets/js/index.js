function _(element) {
    return document.getElementById(element);
}

var logout = _("logout");
logout.addEventListener("click", logout_user);

function get_data(find, type) {
    var xml = new XMLHttpRequest();
    xml.onload = function () {
        if (xml.readyState == 4 && xml.status == 200) {
            handle_result(xml.responseText);
        }
    };
    var data = {};
    data.find = find;
    data.data_type = type;
    data = JSON.stringify(data);
    xml.open("POST", "api.php", true);
    xml.send(data);
}

function handle_result(result) {
    if (result.trim() !== "") {
        try {
            var obj = JSON.parse(result);
            if (typeof obj.logged_in !== "undefined" && !obj.logged_in) {
                window.location = "login.php";
            } else {
                switch (obj.data_type) {
                    case "user_info":
                        var username = _("username");
                        var email = _("email");

                        if (username && email) {
                            username.innerHTML = obj.username || "N/A";
                            email.innerHTML = obj.email || "N/A";
                        }
                        break;
                    case "logout":
                        window.location = "login.php";
                        break;
                    default:
                        console.error("Unknown data type:", obj.data_type);
                }
            }
        } catch (e) {
            console.error("Error parsing response:", e);
        }
    }
}

function logout_user() {
    var answer = confirm("Are you sure you want to log out?");
    if (answer) {
        get_data({}, "logout");
    }
}

// Fetch user info on page load
get_data({}, "user_info");