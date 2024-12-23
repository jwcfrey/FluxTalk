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
    <link rel="stylesheet" href="/assets/css/index.css?v=<?php echo time(); ?>">
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

// $result = $result[0];
$info->message = $mydata;
$info->data_type = "contacts";
echo json_encode($info);

die;

$info->message = "No contacts were found";
$info->data_type = "error";
echo json_encode($info);
?>
