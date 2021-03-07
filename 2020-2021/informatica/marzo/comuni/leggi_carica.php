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


function carica2($file, $table, $connessione) {
    echo "popolo " . $table . "<br>";

    $CSVfp = fopen($file, "r");

    if($CSVfp !== FALSE) {
        $i = 0;
        while (!feof($CSVfp)) {
            $data = fgetcsv($CSVfp, 1000, ";");
            if ($i++ != 0) {
                if (is_array($data)) {
                    //print_r($data);
                    $row = explode(",", $data[0]);
                    $params = " '".$connessione->real_escape_string($row[0])."', 
                                '".$connessione->real_escape_string($row[1])."',
                                '".$connessione->real_escape_string($row[2])."',
                                '".$connessione->real_escape_string($row[3])."'";

                    $ris = $connessione->query("insert into ".$table." values (".$params.")");
                    if ($ris == false) {
                        echo "Errore inserimento " . $params . " errore: " . htmlspecialchars($connessione->error) . " (insert into ".$table." values (".$params."))<br>";
                    }
                }
            }
        }
    }
    /*
    if ( $xlsx = SimpleXLSX::parse($file ) ) {
        $i = 0;
        foreach ($xlsx->rows() as $row) {
            if ($i != 0) {
                $params = " '".$connessione->real_escape_string($row[0])."', 
                            '".$connessione->real_escape_string($row[1])."',
                            '".$row[2]."',
                            '".$row[3]."'";

                echo print_r($row) . "<br>";

                $ris = $connessione->query("insert into ".$table." values (".$params.")");
                if ($ris == false) {
                    echo "Errore inserimento " . $params . " errore: " . htmlspecialchars($connessione->error) . " (insert into ".$table." values (".$params."))<br>";
                }
            }else ++$i;
        }
    }
    */
}
