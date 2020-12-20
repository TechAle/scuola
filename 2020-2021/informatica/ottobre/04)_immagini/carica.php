<?php
// Keys: name type tmp_name error size
$immagine = $_FILES["immagine"];
$estenzioni_consentite = array("png", "jpg");
// Dimensione massima
$dim_max = (int) 5E6;
echo filesize($immagine["tmp_name"]);
echo "<br>";
echo $immagine["size"];
// Controllo estensione dell'immagine
if (in_array($ext = strtolower(explode('.', $immagine["name"])[1]), $estenzioni_consentite)) {
    if ($immagine["size"] < $dim_max) {
        $IP = $_SERVER["REMOTE_ADDR"];
        $nome = $_POST["nome"];
        $titolo = $_POST["titolo"];
        $time_stamp = date("Y-m-d-H-i-s");
        $random_number = rand(1, 101);

        scrivi($time_stamp, $random_number, '.' . $ext, $IP, $nome, $titolo, $immagine);
    }
    else echo "Dimensione massima 5mb";
} else echo "estensione non supportata";

function scrivi($time_stamp,$random, $ext, $ip, $nome_autore, $titolo_immagine, $file) {
    $path = "./immagini/" . $time_stamp . $random;
    move_uploaded_file($file["tmp_name"], $path . $ext);
    $f=fopen($path . ".txt","w") or die ("Errore scrittura file");
    // nome utente;ip;titolo immagine;nome file;timestamp caricamento
    fprintf($f, "%s;%s;%s;%s;%s", $nome_autore, $ip, $titolo_immagine, $nome_autore, $time_stamp);
    fclose($f);
}



