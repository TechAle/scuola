<?php

$conn = "";

include "connectionMain.php";

$sql = "DROP DATABASE db_personale";

if ($conn->query($sql) === TRUE) {
    echo "Database eliminato";
} else {
    echo "Il database non esiste";
}