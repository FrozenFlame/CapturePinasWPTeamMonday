<?php

function area($x, $y, $format) {
    
    $area = $x * $y;
    
    $output = "<$format>$area</$format>";
    return ($output);
    echo "Hi!";
    
}

echo area(3,3,'h1');


?>