<?php
$utente = $_GET["file"];
$path = "./immagini/";
foreach(scandir($path) as $file) {
    if( substr($file, -3) == "txt" ) {
        $f = fopen($path . $file, 'r');
        $parti = explode(";", fgets($f));
        // nome utente;ip;titolo immagine;nome file;timestamp caricamento
        if ($parti[0] == $utente) {
            $nome_file = substr($file, 0, -4);
            $nome_file .= file_exists($path . $nome_file . ".png") ? ".png" : ".jpg";
            list($width, $height) = getimagesize($path . $nome_file);
            echo sprintf("%s %s %s %s %s <a href='%s'><img src='%s' alt='img' height='50' width='50'></a> <br>",$path[1], $parti[2], $height, $width, filesize($path . $nome_file), $path . $nome_file, $path . $nome_file);
        }

        // ip dalla quale è stata caricata
        //• titolo
        //• dimensioni in altezza e in larghezza
        //• dimensioni in Byte
        //• miniatura dell'immagine
    }
}