<?php
    $materie = array("Italiano", "Matematica", "Informatica");
    $insufficenze = 0;
    foreach ($materie as $materia) {
        $voto = rand(2,10);
        if ( $voto < 6 )
            $insufficenze += 1;
        echo $materia . " " . ($voto < 6 ? "insufficente" : "sufficente") . "<br>";
    }
    echo "Alunno " . ($insufficenze == 0 ? "promosso" : ($insufficenze < 3 ? "rimandato" : "bocciato"));