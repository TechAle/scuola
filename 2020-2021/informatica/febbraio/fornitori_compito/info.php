<!DOCTYPE html>
<html lang="it">
<head>
<title>Operazioni basilari PHP/Mysql</title>
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
include("./parametri.php");

//connessione al DBMS
$connessione = new mysqli($db_host,$db_user,$db_pass);
if ($connessione->connect_errno) 
    {
    echo "<p style='color: red;'>Errore di connessione al database: " . htmlspecialchars($connessione->connect_error) . "</p>";
    exit();
    }
$connessione->select_db($db_name);
echo "Informazioni sul client: <br>".$connessione->get_client_info()."<br><hr>";
echo "Informazioni sull'host: <br>".$connessione->host_info."<br><hr>";
echo "Informazioni sul server: <br>".$connessione->server_info."<br><hr>";
$ris = $connessione->query("SHOW TABLES");
if (!$ris) 
    {
    echo "<p style='color: red;'>Errore database, Impossibile elencare le tabelle! Errore MySQL: " . $connessione->error."</p>";
    exit();
    }
while($tabelle = mysqli_fetch_row($ris))
    {
    $nomet = $tabelle[0];
    echo '<h3>' ,$nomet, '</h3>';
    $ris2 = $connessione->query("select * from $nomet;");
    $campi = $ris2->field_count;
    $righe   = $ris2->num_rows;
    echo "La tabella '".$nomet."' ha ".$campi." campi e ".$righe." record<br><br>";
    $ris2 = $connessione->query("SHOW COLUMNS from ".$nomet.""); 
    if(mysqli_num_rows($ris2))
        {
        echo '<table border="1" class="table table-striped table-bordered table-hover">';
        echo '<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>';
        while($row2 = mysqli_fetch_row($ris2))
            {
            echo '<tr>';
            foreach ($row2 as $key=>$value)
                {
                echo '<td>',$value, '</td>';
                }
            echo '</tr>';
            }
        echo '</table><br />';
        }
    $ris2->close();
    }
$ris->close();
$connessione->close();
?>
<p><a href="index.php"><-- Ritorna alla pagina principale</a></p>
</main>
<script type="text/javascript" src="prism.js"></script>
</body>
</html>
