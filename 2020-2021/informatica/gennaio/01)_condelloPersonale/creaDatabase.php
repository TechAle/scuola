<?php

$conn = "";

include "connectionMain.php";

$sql = "CREATE DATABASE db_personale";

if ($conn->query($sql) === TRUE) {
    echo "Database creato";
} else {
    echo "Il database già esiste";
}