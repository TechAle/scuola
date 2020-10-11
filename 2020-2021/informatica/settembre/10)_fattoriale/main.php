<?php
    function fattoriale($num) {
        $output = 1;
        for($i = 2; $i <= $num; $i++){
            $output *= $i;
        }
        return $output;
    }

    $nums = range(1, 5);

    foreach ($nums as $num) {
        echo sprintf("Fattoriale %d : %d <br>", $num, fattoriale($num));
    }