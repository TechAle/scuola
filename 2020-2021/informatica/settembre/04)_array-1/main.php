<?php
    $array = [];
    for($i = 0; $i < 10; $i++) {
        array_push($array, rand(60, 100));
        echo $array[$i] . "<br>";
    }