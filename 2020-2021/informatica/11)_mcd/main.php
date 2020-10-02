<?php
    function MCD($n1, $n2) {
        while ($n1 <> $n2) {
            if ($n1 > $n2)
                $n1 = $n1 - $n2;
            else
                $n2 = $n2 - $n1;

        }
        return $n1;
    }

    echo mcd(32, 40);