<?php
$connect=mysqli_connect('localhost','jarvis','pass123','sample');
 
if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}
 
?>