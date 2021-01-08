<?php
$conn = "";

include "connectionMain.php";

$sql = "SELECT Cognome, Nome, codFisc, Assunto, Filiale, Funzione, Livello, StipBase, Via, Cap, Citta, Prov FROM db_personale.personale";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo "<div style='font-size: 10px'>";
    while($row = $result->fetch_assoc()) {
        echo "Cognome: " . $row["Cognome"] . " Nome: " . $row["Nome"] . " codFisc: " . $row["codFisc"] . " Assunto: " . $row["Filiale"] .
            " Funzione: " . $row["Funzione"] . " Livello: " . $row["Livello"] . " StipBase: " . $row["StipBase"] . " Via: " . $row["Via"] .
            " Cap: " . $row["Cap"] . " Citta: " . $row["Citta"] . " Provincia: " . $row["Prov"] . "<hr>";
    }
    echo "</div>";
} else {
    echo "Non ho trovato nulla";
}