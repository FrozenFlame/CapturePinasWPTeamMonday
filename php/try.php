<?php 
    # set.php is to prepare the SESSION and Cookies for use throughout the website.
    include_once('../php/connection.php');
    $db = new Connection();
    $db = $db->dbConnect(); 
    $query = $db->prepare("SELECT * FROM post");
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    print_r($result['timestamp']);
?>
