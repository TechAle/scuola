<?php
$path = "./immagini/";
$nomi = array();
foreach(scandir($path) as $file) {
    if( substr($file, -3) == "txt" ) {
        $f = fopen($path . $file, 'r');
        // nome utente;ip;titolo immagine;nome file;timestamp caricamento
        $parti = explode(";", fgets($f));
        if(in_array($parti[0], array_keys($nomi)))
            $nomi[$parti[0]]++;
        else
            $nomi[$parti[0]] = 1;
    }
}
ksort($nomi);
foreach (array_keys($nomi) as $keys) {
    echo sprintf("<a href='elenco_immagini.php?file=%s'>%s</a> %s <br>",$keys, $keys, $nomi[$keys]);
}
