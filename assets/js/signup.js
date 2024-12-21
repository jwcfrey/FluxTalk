function _(element) {
    return document.getElementById(element);
}

var signup_button = _("signup_button");
signup_button.addEventListener("click", collect_data);

function collect_data() {
    var myform = _("myform");
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
    send_data(data, "signup");
}

function send_data(data, type) {
    var xml = new XMLHttpRequest();
    xml.onload = function () {
        if (xml.readyState == 4 || xml.status == 200) {
            alert(xml.responseText);
        }
    }
    data.data_type = type;
    var data_string = JSON.stringify(data);
    xml.open("POST", "api.php", true);
    xml.send(data_string);
}