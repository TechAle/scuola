<?php
$db_host = "";
$db_user = "";
$db_pass = "";
$db_name = "";
include "parametri.php";
$conn = new mysqli($db_host,$db_user,$db_pass, $db_name) or die("Errore connessione server");
if (isset($_POST)) {
    $domanda = $_POST["domanda"];
    if ($domanda == null) {
        echo "Domanda non trovata";
        return;
    } else {
        $sql = "INSERT INTO dr_domande(domanda) VALUES (".$conn->real_escape_string($domanda).")";
        $ris = $conn->query($sql);
        if (!$ris) {
            echo "Errore inserimento dati";
            return;
        } else {
            header("index.php");
        }
    }
} else {
    echo "Opzione non valida";
    return;
}