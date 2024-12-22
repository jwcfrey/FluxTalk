function _(element) {
    return document.getElementById(element);
}

function get_data(find, type) {
    var xml = new XMLHttpRequest();
    xml.onload = function () {
        if (xml.readyState == 4 || xml.status == 200) {
            handle_result(xml.responseText);
        }
    }
    var data = {};
    data.find = find;
    data.data_type = type;
    data = JSON.stringify(data);
    xml.open("POST", "/api.php", true);
    xml.send(data);
}

function handle_result(result, type) {
    if (result.trim() != "") {
            var obj = JSON.parse(result);
            if (!obj.logged_in) {
                window.location = "/login.php";
            } else {
                alert(result);
            }
    }
}

get_data({}, "user_info");