<?php

    $array = [10,3,1,100,230,56,33,53,91,24];
    foreach ($array as $valore) {
        echo $valore . "<br>";
    }
    echo "Inverso <br>";
    foreach (array_reverse($array) as $valore) {
        echo $valore . "<br>";
    }
    $pari = [];
    $dispari = [];
    foreach ($array as $valore) {
        if ( $valore % 2 == 0 )
            array_push($pari, $valore);
        else
            array_push($dispari, $valore);
    }
    echo "Pari: <br>";
    foreach ($pari as $valore) {
        echo $valore . "<br>";
    }
    echo "Dispari: <br>";
    foreach ($dispari as $valore) {
        echo $valore . "<br>";
    }