<!--
Visualizzare l'elenco delle diverse province di residenza del personale
-->
<!DOCTYPE html>
<html lang="it">
<head>
<title>Popola tabelle</title>
  <meta charset="UTF-8"/>
        <link rel="stylesheet" href="rsc/css/bootstrap.min.css"/>
        <style type="text/css">
            body {
                padding-top: 5vh;
            }
        </style>
        <link rel="stylesheet" href="prism.css"/>
</head>
<body>
<main role="main" class="container">
<?php 
//inclusione parametri
require_once("parametri.php");   
require_once("libreria.php");    
//connessione al DBMS
$connessione = new mysqli($db_host,$db_user,$db_pass);
if ($connessione->connect_errno) 
    {
    echo "<p style='color: red;'>Errore di connessione al database: " . htmlspecialchars($connessione->connect_error) . "</p>";
    exit();
    }
$connessione->select_db($db_name);

//popola tabella filiali

$tabella="tbfornitori";
$file_csv="./csv/tbfornitori.csv";
$rit=carica_csv($tabella,$connessione,$file_csv,FALSE,$debug);

//popola tabella filiali

$tabella="tbreparti";
$file_csv="./csv/tbreparti.csv";
$rit=carica_csv($tabella,$connessione,$file_csv,FALSE,$debug);

//popola tabella filiali

$tabella="tbcategorie";
$file_csv="./csv/tbcategorie.csv";
$rit=carica_csv($tabella,$connessione,$file_csv,FALSE,$debug);

//popola tabella filiali

$tabella="tbarticoli";
$file_csv="./csv/tbarticoli.csv";
$rit=carica_csv($tabella,$connessione,$file_csv,FALSE,$debug);

//popola tabella filiali

$tabella="tbacquisti";
$file_csv="./csv/tbacquisti.csv";
$rit=carica_csv($tabella,$connessione,$file_csv,FALSE,$debug);

$connessione->close();   
?>
<p><a href="index.php"><-- Ritorna alla pagina principale</a></p>
</main>
<script type="text/javascript" src="prism.js"></script>
</body>
</html>

