<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        html, body {
            height: 100vh;
            background-color: #90A4AE;
            padding: 0;
            margin: 0;
            overflow-y: hidden;
        }
        #footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 50px;
            padding: 0;
            margin: 0;
            background-color: #e6e6e6;
        }
        #main {
            background-color: white;
            margin: 85px 10px 10px 50px;
            height: 69%;
            width: 88%;
            padding: 15px;
            overflow-y: scroll;
        }

        .shadow {
            box-shadow:0px 10px 25px -5px rgba(0,0,0,0.25);
        }

        .column {
            float: left;
            width: 33%;
            height: 100vh;
            border-width: 1px; border-color: lightgray;
            text-align: center;
        }


        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            display: inline-flex;

        }
        .button {
            padding: 4px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            transition-duration: 0.4s;
            cursor: pointer;
            background-color: white;
            color: black;
            border: 2px solid #008CBA;
            border-radius: 4px;
            margin-top: 10px;
            margin-left: 10px;
        }

        .button:hover {
            background-color: #008CBA;
            color: white;
        }
        #patrono {
            position: absolute;
            right: 18px;
            top: 18px;
        }
        #dinamico {
            position: absolute;
            right: 46.5%;
        }
        .colonna {
            display: block;
            width: 95%;
        }
        .colonna2 {
            margin-left: 15px;
            width: 93%;
            display: block;
        }
        .scelto {
            background-color: #f5dda9;
        }
    </style>

</head>
<body>

<header>
    <form action="popolazione.php">
    <input class="button shadow" type="submit" value="Grafico popolazione">
    </form>
    <button class="button shadow" id="dinamico">Dinamico</button>
    <form id="patrono" action="autosuggestion.php" method="get">
        <label>
            Patrono: <input type="text" name="patrono" placeholder="San Massimo" class="shadow">
        </label>

        <input type="submit" value="invia">
    </form>
</header>

<div id="main" class="shadow">
    <div>
        <div class="row">
            <div class="column" style="border-style: hidden solid hidden hidden;">REGIONI
                <form method="get">
                    <?php
                    // Entro nel db
                    require "parametri.php";
                    $selezionato = "";
                    $connessione = new mysqli($db_host,$db_user,$db_pass);
                    $connessione->select_db("comuni");
                    // Prendo, se lo abbiamo, ciò che avevamo selezionato
                    if(isset($_GET["regione"])) {
                        $selezionato = $connessione->real_escape_string($_GET["regione"]);
                    }
                    // Prendo tutte le regioni
                    $query = "select distinct regione from citta";
                    $ris = $connessione->query($query) or die ("Errore esecuzione query " . $query);
                    if ($ris) {
                        // Prendo i risultati
                        $numRighe = $ris->num_rows;
                        while($row = $ris->fetch_row())
                        {
                            // Se lo avevamo già selezionato, fallo giallo
                            $add = "";
                            if ($selezionato == $connessione->real_escape_string($row[0]))
                                $add = "scelto";
                            // Li stampo
                            echo '<input type="submit" value="'.$row[0].'" name="regione" class="colonna '.$add.'">';
                        }
                    }
                    ?>
                </form>
            </div>
            <div class="column" style="border-style: hidden solid hidden hidden;">
                PROVINCE
                <form method="get">
                <?php
                if (isset($_GET["regione"])) {
                    // Prendo la provincia se l'abbiamo selezionata
                    if(isset($_GET["provincia"])) {
                        $selezionato = $connessione->real_escape_string($_GET["provincia"]);
                    }

                    $value = $connessione->real_escape_string($_GET["regione"]);
                    // Prendo tutte le varie province
                    $query = "select DISTINCT prov.provincia from citta, prov where citta.regione = '".$value."' && citta.provincia = prov.sigle";
                    $ris = $connessione->query($query) or die("Errore esecuzione query " . $query);
                    if ($ris) {
                        if ($ris->num_rows > 0) {
                            // Rendo invisibile il nostro valore hidden per ricordo
                            echo "<input type='hidden' name='regione' value='" . $value . "'>";
                            $numRighe = $ris->num_rows;
                            // Stampo
                            while($row = $ris->fetch_row())
                            {
                                // Se l'avevamo già selezionato, giallo
                                $add = "";
                                if ($selezionato == $connessione->real_escape_string($row[0]))
                                    $add = "scelto";
                                // Inserisco
                                echo '<input type="submit" value="'.$row[0].'" name="provincia" class="colonna2 '.$add.'">';
                            }

                        } else die("Non è stata trovata la regione");
                    }
                }
                ?>
                </form>
            </div>
            <div class="column">COMUNI
                <form method="get" action="comune.php">
                <?php

                if(isset($_GET["provincia"]) && isset($_GET["regione"])) {
                    $regione = $connessione->real_escape_string($_GET["regione"]);
                    $provincia = $connessione->real_escape_string($_GET["provincia"]);
                    echo "<input type='hidden' name='regione' value='" . $regione . "'>";
                    echo "<input type='hidden' name='provincia' value='" . $provincia . "'>";
                    // Prendo il codice della provincia
                    $query = "select sigle from prov where provincia like '" . $provincia . "'";
                    $ris = $connessione->query($query) or die("Errore esecuzione query " . $query);
                    if ($ris) {
                        if ($ris->num_rows > 0) {
                            $prov = $ris->fetch_row()[0];
                            // Cerco tutti i comuni
                            $query = "select DISTINCT citta.comune from citta where citta.regione = '".$regione."' && citta.provincia = '".$prov."'";
                            $ris = $connessione->query($query) or die ("Errore esecuzione query " . $query);
                            if ($ris->num_rows > 0 ) {
                                $numRighe = $ris->num_rows;
                                // Stampo
                                while($row = $ris->fetch_row())
                                {
                                    // Inserisco
                                    echo '<input type="submit" value="'.$row[0].'" name="comune" class="colonna2 ">';
                                }
                            } else die ("Non sono state trovate delle citta nella query " . $query);
                        }else die("Non è stata trovata la provincia/regione");

                    }
                }

                ?>
                </form>
            </div>
        </div>
    </div>
</div>

<footer id="footer">
    <div style="padding-top: 15px; text-align: center;">
        Sito creato da Condello Alessandro per scopi didattici
    </div>
</footer>

</body>
</html>