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
}