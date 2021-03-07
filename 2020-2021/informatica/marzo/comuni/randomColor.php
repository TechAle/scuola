<?php
function getRandomColor() {
    $output = "'#";
    for($i = 0; $i < 6; $i++) {
        $output .= oneColor();
    }
    return $output . "', ";
}

function oneColor() {
    return sprintf("%s", dechex(rand(0, 15)));
}