<?php
//Step1return new PDO('mysql:host=localhost; dbname=user_db', 'root', '');

 $db = mysqli_connect('localhost','root','','user_db')
 or die('Error connecting to MySQL server.');
?>
<?php
// create a variable
$username=$_POST['username'];
$fullname=$_POST['fullname'];
$email=$_POST['email'];
$password=$_POST['password'];
 
//Execute the query

 $query = "INSERT INTO user_table(USERNAME,FULLNAME,EMAIL,PASSWORD)
				VALUES('$username','$fullname','$email','$password')";
mysqli_query($db, $query) or die('Error querying database.');

mysqli_close($db);

?>