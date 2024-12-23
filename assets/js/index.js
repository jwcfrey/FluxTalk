var CURRENT_CHAT_USER = "";
function _(element) {
    return document.getElementById(element);
}

var label_contacts = _("label_contacts");
label_contacts.addEventListener("click", get_contacts);

var label_chats = _("label_chats");
label_chats.addEventListener("click", get_chats);

var label_settings = _("label_settings");
label_settings.addEventListener("click", get_settings);

var logout = _("logout");
logout.addEventListener("click", logout_user);

function get_data(find, type) {
    var xml = new XMLHttpRequest();
    var loader_holder = _("loader_holder");
    loader_holder.className = "loader_on";

    xml.onload = function () {
        if (xml.readyState == 4 && xml.status == 200) {
            loader_holder.className = "loader_off";
            handle_result(xml.responseText, type);
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
                        var profile_image = _("profile_image");

                        // Pastikan properti 'image' ada dalam objek
                        if (obj.image && profile_image) {
                            profile_image.src = obj.image;
                        }

                        if (username && email) {
                            username.innerHTML = obj.username || "N/A";
                            email.innerHTML = obj.email || "N/A";
                        }
                        break;
                    case "contacts":
                        var inner_left_pannel = _("inner_left_pannel");
                        inner_left_pannel.innerHTML = obj.message;
                        break;
                    case "chats":
                        var inner_left_pannel = _("inner_left_pannel");
                        inner_left_pannel.innerHTML = obj.message;
                        break;
                    case "settings":
                        var inner_left_pannel = _("inner_left_pannel");
                        inner_left_pannel.innerHTML = obj.message;
                        break;
                    case "save_settings":
                        alert(obj.message);
                        get_data({}, "user_info");
                        get_settings(true);
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
get_data({}, "contacts");

var radio_contacts = _("radio_contacts");
radio_contacts.checked = true;

function get_contacts(e) {
    get_data({}, "contacts");
}

function get_chats(e) {
    get_data({}, "chats");
}

function get_settings(e) {
    get_data({}, "settings");
}

//settings.js

function collect_data() {
    var save_settings_button = _("save_settings_button");
    save_settings_button.disabled = true;
    save_settings_button.value = "Loading.. Please wait...";

    var myform = _("myform");
    if (!myform) {
        console.error("Form with ID 'myform' not found.");
        save_settings_button.disabled = false;
        save_settings_button.value = "Save Settings";
        return;
    }

    var inputs = myform.getElementsByTagName("INPUT");
    var data = {};

    for (var i = inputs.length - 1; i >= 0; i--) {
        var key = inputs[i].name;
        switch (key) {
            case "username":
                data.username = inputs[i].value;
                break;
            case "email":
                data.email = inputs[i].value;
                break;
            case "gender":
                if (inputs[i].checked) {
                    data.gender = inputs[i].value;
                }
                break;
            case "password":
                data.password = inputs[i].value;
                break;
            case "password2":
                data.password2 = inputs[i].value;
                break;
        }
    }
    send_data(data, "save_settings");
}

function send_data(data, type) {
    var xml = new XMLHttpRequest();
    xml.onload = function () {
        if (xml.readyState == 4 || xml.status == 200) {
            handle_result(xml.responseText);
            var save_settings_button = _("save_settings_button");
            save_settings_button.disabled = false;
            save_settings_button.value = "Signup";
        }
    }

    data.data_type = type;
    var data_string = JSON.stringify(data);
    xml.open("POST", "api.php", true);
    xml.send(data_string);
}

function upload_profile_image(files) {
    var change_image_button = _("change_image_button");
    change_image_button.disabled = true;
    change_image_button.innerHTML = "Uploading Image..";
    var myform = new FormData();
    var xml = new XMLHttpRequest();
    xml.onload = function () {
        if (xml.readyState == 4 || xml.status == 200) {
            // alert(xml.responseText);
            change_image_button.disabled = false;
            change_image_button.innerHTML = "Change Image";
        }
    }

    myform.append('file', files[0]);
    myform.append('data_type', "change_profile_image");
    xml.open("POST", "uploader.php", true);
    xml.send(myform);
}

function handle_drag_and_drop(e) {
    if(e.type == "dragover") {
        e.preventDefault();
        e.target.className = "dragging";
    } else if (e.type == "dragleave") {
        e.target.className = "";
    } else if (e.type == "drop") {
        e.preventDefault();
        e.target.className = "";
        upload_profile_image(e.dataTransfer.files);
    } else {
        e.target.className = "";
    }
}

function start_chat(e) {
    let target = e.target;

    // Pastikan untuk mendapatkan atribut 'userid' dari elemen yang benar
    while (!target.hasAttribute("userid") && target.parentNode) {
        target = target.parentNode;
    }

    // Ambil userid yang valid dari elemen
    const userid = target.getAttribute("userid");
    if (userid) {
        CURRENT_CHAT_USER = userid;

        // Alihkan ke tab chat dan ambil data chat
        const radio_chat = _("radio_chat");
        if (radio_chat) {
            radio_chat.checked = true;
        }
        get_data({ userid: CURRENT_CHAT_USER }, "chats");
    } else {
        console.error("Error: User ID not found in the clicked element.");
    }
}
