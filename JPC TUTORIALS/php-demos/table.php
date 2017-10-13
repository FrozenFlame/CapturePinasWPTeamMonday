<?php

echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Password</th>
        <th>Secrets</th>
    </tr>";
    
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

$sql = "SELECT * FROM `test_db` ORDER BY `name`";

$result = $db->query($sql);
    
    while ($row = $result->fetch_object()) {
       $id = $row->id;
       $name = htmlentities($row->name, ENT_QUOTES, "UTF-8");
       $password = $row->password;
       $secrets = htmlentities($row->secrets, ENT_QUOTES, "UTF-8");
       echo "<tr>
                <td>$id</td>
                <td>$name</td>
                <td>$password</td>
                <td>$secrets</td>
            </tr>";
    }
    
echo "</table>";
?>