<?php

$day = date('l');
$date = date('dS');
$month = date('M');
$year = date('Y');
$hours = date('H');
$minutes = date('i');
$seconds = date('s');

echo "<p>Today is $day</p>";

echo "<p>Today is ". $day. "</p>";

$x = 5;

echo "5 + 1 is $x + 1";
echo"<br>";
echo "5 + 1 is ".($x + 1);


?>

<p>Today is <?php echo $day?></p>

// HOMEWORK <br>
<?php
echo "<p>The date today is $day $date $month $year. This time next year it will be $date $month ".($year + 1).".</p>";
?>