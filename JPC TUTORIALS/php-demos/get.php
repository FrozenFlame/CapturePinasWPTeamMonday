<?php
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    echo "The user ID you have chosen is $user_id";
}

else {
    echo "User ID not set";
}

?>