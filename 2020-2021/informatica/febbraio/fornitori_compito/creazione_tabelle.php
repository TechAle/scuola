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

//creazione tabella tbacquisti
$query=<<<SQL
    CREATE TABLE tbacquisti
    (idacquisto TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    ksarticolo INT(4) UNSIGNED NOT NULL , 
     ksfornitore TINYINT UNSIGNED NOT NULL,
      quantita DECIMAL(6,2) NOT NULL,
      costo DECIMAL(8,2) NOT NULL,
      dataacquisto DATE NOT NULL) ;
    SQL;

esegui_query($query,$connessione);

//creazione tabella tbfornitori
$query=<<<SQL
    CREATE TABLE tbfornitori
    (idfornitori TINYINT UNSIGNED PRIMARY KEY,
        ragionesociale VARCHAR(40), 
    indirizzo VARCHAR(30) NOT NULL,
    residenza VARCHAR(30) NOT NULL,
    partitoiva VARCHAR(11), 
    telefono VARCHAR(15) ,
    email VARCHAR(30) NOT NULL 
    ) ;
    SQL;

esegui_query($query,$connessione);

//creazione tabella tbarticoli
$query=<<<SQL
    CREATE TABLE tbarticoli
    (idarticolo INT(4) UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
    articolo CHAR(30),
    ksreparto INT(4) UNSIGNED,
    kscategoria int(4) unsigned,
    prezzovendita DECIMAL(4,2),
    sconto decimal(4,2),
    giacenza decimal(6,2),
    scortamax decimal(6,2),
    scortamin decimal(6,2)
    ) ;
    SQL;

esegui_query($query,$connessione);

//creazione tabella tbreparti
$query=<<<SQL
    CREATE TABLE tbreparti
    (idreparto int(4) UNSIGNED primary key AUTO_INCREMENT, 
    reparto varchar(30)
    ) ;
    SQL;

esegui_query($query,$connessione);

//creazione tabella tbcategorie
$query=<<<SQL
    CREATE TABLE tbcategorie
    (idcategoria int(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY , 
    categoria CHAR(30)
    ) ;
    SQL;



esegui_query($query,$connessione);

$connessione->close();   

?>
<p><a href="index.php"><-- Ritorna alla pagina principale</a></p>
</main>
<script type="text/javascript" src="prism.js"></script>
</body>
</html>

