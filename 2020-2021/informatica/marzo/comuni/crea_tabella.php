<?php
function crea_tab($conn, $query, $nome) {
    $esiste = "show tables like '" . $nome . "'";
    $ris = $conn->query($esiste);
    if ($ris->num_rows > 0) {
        echo "Tabella " . $nome . " già esiste";
    }else {
        echo "Tabella " . $nome . " non esiste, ";
        $risCreat = $conn->query($query);
        if ($risCreat) {
            echo " ma creata con successo";
        }else echo ", non è possibile crearla, erroe: " . htmlspecialchars($conn->error);
    }
    echo "<br>";
}