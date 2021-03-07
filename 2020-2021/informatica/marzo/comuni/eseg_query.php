<?php
function eseguo_query($query,$connessione)
{
    echo "Eseguo query: $query <br>";
    $ris = $connessione->query($query);
    if ($ris == false)
    {
        echo "Errore della query: " . htmlspecialchars($connessione->error);
    }
    else
    {
        echo "Query eseguita correttamente";
    }
    echo "<br>";
}