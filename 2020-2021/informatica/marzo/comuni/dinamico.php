<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-left: 10px;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
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

        .colonna {
            display: block;
            width: 95%;
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
        .scelto {
            background-color: #f5dda9;
        }
        .check {
            display: block;
            text-align: left;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

<header>
    <button class="button shadow">Indietro</button>
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
            <div class="column" style="border-style: hidden solid hidden hidden;">PROVINCE

                <form>

                    <?php
                    if(isset($_GET["regione"])) {
                        $value = $connessione->real_escape_string($_GET["regione"]);
                        $query = "select DISTINCT prov.provincia from citta, prov where citta.regione = '" . $value . "' && citta.provincia = prov.sigle";
                        $ris = $connessione->query($query) or die("Errore esecuzione query " . $query);
                        if ($ris) {
                            if ($ris->num_rows > 0) {
                                // Rendo invisibile il nostro valore hidden per ricordo
                                echo "<input type='hidden' name='regione' value='" . $value . "'>";
                                $numRighe = $ris->num_rows;
                                // Stampo
                                while ($row = $ris->fetch_row()) {
                                    echo sprintf('<label class="check">
                                                <input class="c" type="checkbox" name="provincia" value="%s">
                                                %s
                                            </label>', $row[0], $row[0]);
                                }

                            } else die("Non è stata trovata la regione");
                        }
                    }
                    ?>

                </form>

            </div>
            <div class="column">RISULTATO
                <div id="risultato">
                <?php
                if (isset($_POST["provincie"])) {
                    $query =   "select citta.comune, citta.num_residenti / citta.superficie as 'densita' from citta
                                where citta.provincia in (select distinct provincia from citta
                                where citta.comune in (".$_POST['provincie']."))
                                order by densita desc";
                    $ris = $connessione->query($query) or die("Errore esecuzione query " . $query);

                    if ($ris) {
                        // Prendo i risultati
                        $numRighe = $ris->num_rows;
                        echo sprintf('<table>
                                        <tr>
                                            <th>Comune</th>
                                            <th>Densita</th>
                                        </tr>');
                        while($row = $ris->fetch_row())
                        {
                            echo sprintf("<tr><th>%s</th><th>%s</th></tr>", $row[0], $row[1]);

                        }
                        echo sprintf('</table>');
                    }

                }
                ?>
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
var a;
    $(document).ready(function(){
        $(".c").change(function(){
            var output = ""
            $('input[name="provincia"]:checked').each(function() {
                output += "'" + this.value + "',";
            });
            output = output.substr(0, output.length - 1)
            $.ajax({
               type: "POST", url: "dinamico.php",
                data: 'provincie=' + output,
                success: function (risposta) {
                   var content = $( risposta ).find( "#risultato" );
                   a = risposta;
                    $( "#risultato" ).empty().append( content );
                }
            });
        });
    });

</script>

</body>
</html>