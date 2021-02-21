<!--
cancellazione tabelle
-->
<!DOCTYPE html>
<html lang="it">
<head>
<title>Svuota tabelle</title>
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


$tabella="tbacquisti";
svuota_tabella($tabella,$connessione);

$tabella="tbfornitori";
svuota_tabella($tabella,$connessione);

$tabella="tbreparti";
svuota_tabella($tabella,$connessione);

$tabella="tbarticoli";
svuota_tabella($tabella,$connessione);

$tabella="tbreparti";
svuota_tabella($tabella,$connessione);

$tabella="tbcategorie";
svuota_tabella($tabella,$connessione);


?>
<p><a href="index.php"><-- Ritorna alla pagina principale</a></p>
</main>
<script type="text/javascript" src="prism.js"></script>
</body>
</html>

