<?php
    $pari = 0;
    $dispari = 0;
    for ($i = 1; $i <= 10; $i++) {
        if ( $i % 2 == 0 )
            $pari += $i;
        else
            $dispari += $i;
    }
    echo sprintf("Pari: %d <br> Dispari: %d", $pari, $dispari);


