<?php

$conn = "";

include "connectionMain.php";

if ($conn->select_db('db_personale') === true) {

    $codeSql = "DROP TABLE db_personale.personale";

    $ris = $conn->query($codeSql);

    if ($ris == true) {
        echo "tolta la tabella";
    }else echo "errore distruzione tabella";


}else echo "Database non è stato creato";