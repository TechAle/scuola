<?php

function carica($file, $table, $connessione) {
    echo "popolo " . $table . "<br>";
    if ( $xlsx = SimpleXLSX::parse($file ) ) {
        $i = 0;
        foreach ($xlsx->rows() as $row) {
            if ($i != 0) {
                $params = "";
                $max = count($row);
                for($i = 0; $i < $max; $i++) {
                    if ($i != 0) {
                        $params .= ",'" . $connessione->real_escape_string($row[$i]) . "'";
                    }else $params .=  "'" . $connessione->real_escape_string($row[$i]) . "'";
                }


                $ris = $connessione->query("insert into ".$table." values (".$params.")");
                if ($ris == false) {
                    echo "Errore inserimento " . $params . " errore: " . htmlspecialchars($connessione->error) . " (insert into ".$table." values (".$params."))<br>";
                }
            }else ++$i;
        }
    }
}

function carica1($file, $table, $connessione) {
    echo "popolo " . $table . "<br>";
    if ( $xlsx = SimpleXLSX::parse($file ) ) {
        $i = 0;
        foreach ($xlsx->rows() as $row) {
            if ($i != 0) {
                $params = "'".$connessione->real_escape_string($row[0])."', '".$connessione->real_escape_string($row[1])."'";
                if ($row[2] != "") {
                    $params .= ",'".$row[2]."'";
                }else $params .= ",''";


                $ris = $connessione->query("insert into ".$table." values (".$params.")");
                if ($ris == false) {
                    echo "Errore inserimento " . $params . " errore: " . htmlspecialchars($connessione->error) . " (insert into ".$table." values (".$params."))<br>";
                }
            }else ++$i;
        }
    }
}

