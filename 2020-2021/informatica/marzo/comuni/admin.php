<form method="get">
    <input type="submit" value="creadb" name="creadb"><br>
    <input type="submit" value="crea tabelle" name="creatabelle">
    <input type="submit" value="del tabelle" name="delabella">
    <input type="submit" value="reset tabelle" name="resetabella"><br>
    <input type="submit" value="vincoli" name="vincoli">
    <input type="submit" value="popola" name="popola"><br>
    <label>Query libera <input type="submit" value="es" name="es"></label><br>
    <textarea name="libera" style="width: 500px; height: 100px"><?php echo $_GET["libera"] ?></textarea>
</form>

<img style="position: absolute; right: 0; top: 0; width: 450px; height: 400px" src="./img/db.png">

<?php
require "parametri.php";
require "crea_tabella.php";
require "esegui_query.php";
require "eseg_query.php";
require "SimpleXLSX.php";
require "leggi_carica.php";
$connessione = new mysqli($db_host,$db_user,$db_pass);

if (isset($_GET["creadb"])) {
    echo "Risultato: <br>";
    $exist = "SELECT SCHEMA_NAME
                  FROM INFORMATION_SCHEMA.SCHEMATA
                 WHERE SCHEMA_NAME = 'comuni'
                ";
    $ris = $connessione->query($exist);

    if ($ris->num_rows == 0) {
        echo "Non esiste, creazione in corso";
        $creazione = "CREATE DATABASE comuni";
        $ris = $connessione->query($creazione);
        if ($ris) {
            echo "<br> Creazione avvenuta con successo";
        }else echo "errore esecuzione ".$creazione."  " . htmlspecialchars($connessione->error);
    }
    else
        echo "il database esiste gia";
}
else if (isset($_GET["creatabelle"])) {
    echo "creazione tabella <br>";
    $ris = $connessione->select_db("comuni");
    if ($ris == false) {
        echo "errore connessione database";

    }else {
        $capTable = "create table cap (
                    istat int unsigned primary key,
                    cap varchar(11) not null,
                    cap2 varchar(11)
                )";

        $citTable = "create table citta (
                    istat int unsigned primary key,
                    comune varchar(50) not null,
                    regione varchar(30) not null,
                    provincia varchar(2) not null,
                    prefisso varchar(5) not null,
                    cod_fisco varchar(4) not null,
                    superficie decimal(10,4) not null,
                    num_residenti int unsigned not null
                )";
        $geoTable = " create table geo (
                        istat int unsigned primary key,
                        comune varchar(50) not null,
                        lng varchar(50) not null,
                        lat varchar(50) not null
                    )";
        $infoTable = "create table info (
                        istat int unsigned primary key,
                        comune varchar(50) not null,
                        abitanti varchar(80) not null,
                        patrono_nome tinytext not null,
                        patrono_data tinytext not null
                    )";
        $municTable = "create table munic (
                        istat int unsigned primary key,
                        comune varchar(50) not null,
                        indirizzo varchar(50) not null
                    )";
        $provincTable = "create table prov (
                        sigle varchar(2) primary key,
                        provincia varchar(30) not null
                    )";
        crea_tab($connessione, $capTable, "cap");
        crea_tab($connessione, $citTable, "citta");
        crea_tab($connessione, $geoTable, "geo");
        crea_tab($connessione, $infoTable, "info");
        crea_tab($connessione, $municTable, "munic");
        crea_tab($connessione, $provincTable, "prov");
        }
}
else if (isset($_GET["delabella"])) {
    echo "Esecuzione eliminazione tabella..<br>";
    $tabs = array("cap", "geo", "info", "munic","citta", "prov");
    $connessione->select_db("comuni");
    foreach ($tabs as $tab) {
        $query = "show tables like " . $tab;
        $ris = $connessione->query($query);
        if ($ris->num_rows > 0) {
            echo "Tabella " . $tab . " non esiste";
        }else {
            echo "Tabella " . $tab . " esiste... ";
            $query = 'drop table ' . $tab;
            $ris = $connessione->query($query);
            if ($ris )
                echo " ed è stata eliminata con successo";
            else echo " ma c'è stato (".$query.") un errore durante l'eliminazione: " . htmlspecialchars($connessione->error);
        }
        echo "<br>";
    }
}
else if (isset($_GET["resetabella"])) {
    echo "Esecuzione reset tabella..<br>";
    $tabs = array("cap", "geo", "info", "munic","citta", "prov");
    $connessione->select_db("comuni");
    foreach ($tabs as $tab) {
        $query = "show tables like " . $tab;
        $ris = $connessione->query($query);
        if ($ris->num_rows > 0) {
            echo "Tabella " . $tab . " non esiste";
        } else {
            echo "Tabella " . $tab . " esiste... ";
            $query = 'delete from ' . $tab;
            $ris = $connessione->query($query);
            if ($ris)
                echo " ed è stato eseguito il reset con successo";
            else echo " ma c'è stato (" . $query . ") un errore durante il reset: " . htmlspecialchars($connessione->error);
        }
        echo "<br>";
    }
}
else if (isset($_GET["vincoli"])) {
    echo "eseguo vincoli...";
    $connessione->select_db("comuni");

    //creazione indice su tabella personale
    $query="ALTER TABLE geo ADD INDEX(istat)";

    eseguo_query($query,$connessione);

    //creazione foreign key su tabella personale
    $query="ALTER TABLE geo ADD FOREIGN KEY (istat) REFERENCES citta(istat) ON DELETE RESTRICT ON UPDATE RESTRICT";
    eseguo_query($query,$connessione);

    //creazione indice su tabella personale
    $query="ALTER TABLE info ADD INDEX(istat)";
    eseguo_query($query,$connessione);

    //creazione foreign key su tabella personale
    $query="ALTER TABLE info ADD FOREIGN KEY (istat) REFERENCES citta(istat) ON DELETE RESTRICT ON UPDATE RESTRICT";
    eseguo_query($query,$connessione);

    //creazione indice su tabella personale
    $query="ALTER TABLE munic ADD INDEX(istat)";
    eseguo_query($query,$connessione);

    //creazione foreign key su tabella personale
    $query="ALTER TABLE munic ADD FOREIGN KEY (istat) REFERENCES citta(istat) ON DELETE RESTRICT ON UPDATE RESTRICT";
    eseguo_query($query,$connessione);

    //creazione indice su tabella personale
    $query="ALTER TABLE cap ADD INDEX(istat)";
    eseguo_query($query,$connessione);

    //creazione foreign key su tabella personale
    $query="ALTER TABLE cap ADD FOREIGN KEY (istat) REFERENCES citta(istat) ON DELETE RESTRICT ON UPDATE RESTRICT";
    eseguo_query($query,$connessione);

    //creazione indice su tabella personale
    $query="ALTER TABLE citta ADD INDEX(provincia)";
    eseguo_query($query,$connessione);

    //creazione foreign key su tabella personale
    $query="alter table citta add FOREIGN key(provincia) REFERENCES prov(sigle) ON DELETE RESTRICT ON UPDATE RESTRICT";
    eseguo_query($query,$connessione);

}
else if (isset($_GET["popola"])) {
    $connessione->select_db("comuni");

    carica("./dataset/italy_provincies.xlsx", "prov", $connessione);
    carica("./dataset/italy_cities.xlsx", "citta", $connessione);
    carica("./dataset/italy_munic.xlsx", "munic", $connessione);
    carica("./dataset/italy_info.xlsx", "info", $connessione);
    carica2("./dataset/italy_geo.csv", "geo", $connessione);
    carica1("./dataset/italy_cap.xlsx", "cap", $connessione);


}
if (isset($_GET["es"])) {
    echo "Risultato query [".$_GET["libera"]."]: <br>";
    $connessione->select_db("comuni");
    $ris = $connessione->query($_GET["libera"]);
    if ($ris == True) {
        $numRighe = $ris->num_rows;
        if ($numRighe > 0)
        {
            echo "<table border=\"1\" class=\"table table-striped table-bordered table-hover\">";
            $campi=$ris->fetch_fields();
            echo "<thead> <tr>";
            foreach ($campi as $col)
            {
                echo "<th scope=\"col\">$col->name</th>";
            }
            echo "</tr></thead><tbody>";
            while($row = $ris->fetch_row())
            {
                echo "<tr>";
                for ($i=0;$i<$ris->field_count;$i++)
                {
                    echo "<td>".$row[$i]."</td>";
                }
                echo "</tr>";
            }
            echo "</tbody></table>";
        }
        else
            echo "<h4 style='color: darkseagreen;'>La query non ha restituito risultati.</h4>";
    }else echo "Errore sintassi: " . $connessione->error;
}