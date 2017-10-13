<?php

$dbConnect = array(
    'server' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'name' => 'test_db'
);

$db = new mysqli(
    $dbConnect['server'],
    $dbConnect['user'],
    $dbConnect['pass'],
    $dbConnect['name']
);

echo $db -> host_info;
echo "<br>";
echo $db -> connect_errno;
echo "<br>";

if (($db->connect_errno) > 0){
    echo "Database connection error ".$db->connect_error;
    exit;
}

$sql = "SELECT * FROM `test_db` ORDER BY `name`";

$result = $db->query($sql);

while ($row = $result->fetch_object()) {
    $id = $row->id;
    $name = htmlentities($row->name, ENT_QUOTES, "UTF-8");
    $password = $row->password;
    $secrets = htmlentities($row->secrets, ENT_QUOTES, "UTF-8");
    echo "$id $name $password $secrets<br>";
}



?>