<?php
$db_host = "";
$db_user = "";
$db_pass = "";
$db_name = "";
include "parametri.php";
$conn = new mysqli($db_host,$db_user,$db_pass, $db_name) or die("Errore connessione server");

if (isset($_POST)) {
    $strCod = $_POST["codice"];
    $risposta = $_POST["risposta"];
    $nickname = $_POST["nickname"];
    $file = $_FILES["img"];
    $estenzioni_consentite = array("png", "jpg");

    if (!in_array($ext = strtolower(explode('.', $file["name"])[array_key_last(explode('.', $file["name"]))]), $estenzioni_consentite)) {
        echo "Formato non valido";
        return;
    }


    if ($strCod == null || $risposta == null || $nickname == null || $img == null) {
        echo "Bad Requests";
        return;
    }
    $codice = intval($strCod);
    $imgData =file_get_contents($file);

    $strSql = "UPDATE dr_domande SET risposta = ".$conn->real_escape_string($risposta).", nickname = ".$conn->real_escape_string($nickname).", img = ".$conn->real_escape_string($imgData).", tipo = ".$conn->real_escape_string($ext)." WHERE codice = " . $conn->real_escape_string($codice);

    $ris = $conn->query($strSql);

    if ($ris) {
        header("index.php");
    } else {
        echo "Errore interno";
        return;
    }




} else {
    echo "Bad request";
    return;
}