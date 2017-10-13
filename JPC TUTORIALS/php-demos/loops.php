<?php

$count = 1;

while ($count <= 10){
    echo $count."<br>";
    $count++;
}

for ($count = 1; $count <=10 ; $count++) {
    echo $count . "<br>";
}

?>

<p>HOMEWORK</p>
<?php
for ($i = 1; $i<=10; $i++) {
    for ($i2=1; $i2<=20; $i2++) {
        echo "*";
    }
    echo "<br>";
}