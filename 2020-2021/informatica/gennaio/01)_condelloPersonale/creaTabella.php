<?php

$conn = "";

include "connectionMain.php";

if ($conn->select_db('db_personale') === true) {

    $codeSql = "CREATE TABLE db_personale.personale (
                Matricola INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                Cognome VARCHAR(50) NOT NULL,
                Nome VARCHAR(40) NOT NULL,
                codFisc VARCHAR(16),
                Assunto DATE,
                Filiale INT(1),
                CONSTRAINT Filialeck CHECK (Filiale BETWEEN 1 AND 4),
                Funzione VARCHAR(20),
                Livello VARCHAR(6),
                StipBase FLOAT(7,2),
                Via VARCHAR(20),
                Cap VARCHAR(20),
                Citta VARCHAR(20),
                Prov VARCHAR (2)
                )";

    $ris = $conn->query($codeSql);

    if ($ris == true) {
        echo "creata la tabella con successo";
    }else echo "errore creazione tabella";


}else echo "Database non è stato creato";