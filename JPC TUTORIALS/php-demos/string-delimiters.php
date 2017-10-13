<?php

echo "<p>'Step outside,' he said threateningly.</p>";
echo '<p>"Step outside," he said threateningly.</p>';
echo '<p>"That\'s nice", he said</p>';
echo "<p>\"That's nice\", he said</p>";
/*Backslash escapes following single quote mark so it
no longer functions as string delimiter*/

$today = "Monday";
echo "\$today";

?>

<p>HOMEWORK</p>
<?php
$hour = date('h');
$minutes = date('ia');
echo "\"The time now is $hour:$minutes. In two hours' time it will be ".($hour+1)
.":$minutes\", said the timekeeper.";
