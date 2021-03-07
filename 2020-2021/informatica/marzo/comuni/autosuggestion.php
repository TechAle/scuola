<?php
require "parametri.php";
require "get_comune_wiky.php";
$selezionato = "";
$connessione = new mysqli($db_host, $db_user, $db_pass, "comuni");
if (isset($_GET["patrono"])) {
    $patrono = $connessione->real_escape_string($_GET["patrono"]);
}else die("Patrono non ricevuto");
?>
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

        <h1 style="text-align: center"><?php echo $patrono ?></h1>




            <?php
            $query = 'select comune, patrono_data, abitanti from info  where info.patrono_nome like "'.$patrono.'"';
            $ris = $connessione->query($query) or die("Errore esecuzione " . $query);
            if ($ris->num_rows > 0) {

                echo sprintf('<table>
            <tr>
                <th>Comune</th>
                <th>Data</th>
                <th>Abitanti</th>
            </tr>');

                $numRighe = $ris->num_rows;
                while($row = $ris->fetch_row())
                {
                    echo sprintf("<tr><th>%s</th><th>%s</th><th>%s</th></tr>", $row[0], $row[1], $row[2]);
                }
                echo sprintf('</table>');

            }else echo "Nessun comune con questo patrono";
            ?>





    </div>
</div>

<footer id="footer">
    <div style="padding-top: 15px; text-align: center;">
        Sito creato da Condello Alessandro per scopi didattici
    </div>
</footer>


</body>
</html>