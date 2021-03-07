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
            width: 100%;
            display: block;
        }
        .scelto {
            background-color: #f5dda9;
        }
    </style>

    <script src="./package/dist/Chart.min.js"></script>


</head>
<body>

<header>
    <form action="home.php">
        <input class="button shadow" type="submit" value="indietro">
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
                Popolazione
                <div id="container" style="width: 98%; margin-left: 5px;">
                    <canvas id="canvas2"></canvas>
                </div>
            </div>
            <div class="column">
                Estensione
                <div id="container" style="width: 98%; margin-left: 5px;">
                    <canvas id="canvas"></canvas>
                </div>

            </div>

        </div>
    </div>
</div>

<footer id="footer">
    <div style="padding-top: 15px; text-align: center;">
        Sito creato da Condello Alessandro per scopi didattici
    </div>
</footer>

<script>
    <?php
    require "parametri.php";
    $connessione = new mysqli($db_host,$db_user,$db_pass, "comuni");
    $query =   'SELECT sum(superficie), regione FROM citta
                group by(regione)
                order by sum(superficie)';
    $ris = $connessione->query($query) or die("Errore creazione grafico superficie");
    if ($ris->num_rows > 0) {
        $numRighe = $ris->num_rows;
        // Stampo
        $regioni = "";
        $data = "";
        while($row = $ris->fetch_row())
        {
            $data .= $row[0] . ",";
            $regioni .= "'" . $row[1] . "',";
        }
    }else die("DataBase vuoto");
    ?>
    var ctx = document.getElementById("canvas").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:[<?php echo $regioni ?>],
            datasets: [{
                label : 'provincia',
                backgroundColor: [
                    <?php
                    require "randomColor.php";
                    for($i = 0; $i < count(explode(",", $regioni)); $i++) {
                        echo getRandomColor();
                    }
                    ?>
                ],
                data:[<?php echo $data ?>],
            }]
        },

    });

    <?php
    $ok = 0;
    if (isset($_GET["regione"])) {

        $query =   'select sum(num_residenti), prov.provincia from citta, prov
                        where citta.provincia like prov.sigle and citta.regione like "'.$connessione->real_escape_string($_GET["regione"]).'"
                        group by prov.provincia
                        order by sum(num_residenti) desc';
        $ris = $connessione->query($query);

        if ($ris->num_rows > 0) {
            $numRighe = $ris->num_rows;
            // Stampo
            $provincie = "";
            $data = "";
            while($row = $ris->fetch_row())
            {
                $data .= $row[0] . ",";
                $provincie .= "'" . $row[1] . "',";
            }
            $ok = 1;
        }else die("DataBase vuoto");


    }

    ?>
    var prova = <?php if($ok == 1) echo "true"; else echo "false"; ?>;
    if (prova) {
        var ctx2 = document.getElementById("canvas2").getContext("2d");
        var myChart2 = new Chart(ctx2, {
            type: "bar",
            data: {
                labels:[<?php if($ok == 1) echo $provincie ?>],
                datasets: [{
                    backgroundColor: [
                        <?php
                        if ($ok == 1) {
                            for($i = 0; $i < count(explode(",", $provincie)); $i++) {
                                echo getRandomColor();
                            }
                        }
                        ?>
                    ],
                    data:[<?php if($ok == 1) echo $data ?>],
                }]
            },

        });
    }

</script>


</body>
</html>