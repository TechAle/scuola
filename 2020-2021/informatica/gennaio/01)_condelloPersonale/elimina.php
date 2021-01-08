<?php
$conn = "";

include "connectionMain.php";

$sql = "DELETE FROM db_personale.personale";

if ($conn->query($sql) === TRUE) {
    echo "Righe eliminate";
} else {
    echo "Errore durante l'eliminazione delle righe";
}