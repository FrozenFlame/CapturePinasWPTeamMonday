<?php


$day = date('l');
$hours = date('H');
$minutes = date('i');
$seconds = date('s');
$date = date('dS');
$month = date('M');
$year = date('Y');

$day = "Sunday";
$hour = 13;

if ($hour > 12 && $hour < 18){
    echo "<p>Good afternoon</p>";
}

if ($hour >= 18 && $hour < 23){
    echo "<p>Good evening</p>";
}

if ($day == "Saturday" || $day == "Sunday"){
    echo "<p>I hope you're having a good weekend!</p>";
}


?>

<p>HOMEWORK</p>
<?php
if ($hour >= 6 && $hour <= 12 && $minutes <= 59){
    echo "<p>Good morning</p>";
}
if ($hour >= 12 && $hour <= 18 && $minutes <= 59){
    echo "<p>Good afternoon</p>";
}
if ($hour >= 18 && $hour <= 22 && $minutes <= 59){
    echo "<p>Good evening</p>";
}
if ($hour == 22 && $minutes <= 59){
    echo "<p>Good night</p>";
}
if ($hour == 23 && $minutes <= 59){
    echo "<p>Go to bed</p>";
}
if ($hour >= 12 && $hour <= 6 && $minutes <= 59){
    echo "<p>You should be in bed and asleep!</p>";
}
?>