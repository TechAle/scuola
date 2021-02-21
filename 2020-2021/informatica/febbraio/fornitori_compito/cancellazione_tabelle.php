<!--
Visualizzare l'elenco delle diverse province di residenza del personale
-->
<!DOCTYPE html>
<html lang="it">
<head>
<title>Visualizzazione query</title>
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

$query=<<<SQL
    DROP TABLE tbacquisti
    SQL;

esegui_query($query,$connessione);

$query=<<<SQL
    DROP TABLE tbfornitori
    SQL;

esegui_query($query,$connessione);


$query=<<<SQL
    DROP TABLE tbarticoli
    SQL;

esegui_query($query,$connessione);


$query=<<<SQL
    DROP TABLE tbreparti
    SQL;

esegui_query($query,$connessione);


$query=<<<SQL
    DROP TABLE tbcategorie
    SQL;

esegui_query($query,$connessione);

$connessione->close();   

?>
<p><a href="index.php"><-- Ritorna alla pagina principale</a></p>
</main>
<script type="text/javascript" src="prism.js"></script>
</body>
</html>

