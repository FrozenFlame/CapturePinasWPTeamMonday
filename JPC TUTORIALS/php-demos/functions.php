<?php

$fruit2 = "peaches";

function showFruit() {
    GLOBAL $fruit2;
    $fruit1 = "apples";
    echo $fruit1;
    echo $fruit2;
}

showFruit();


?>