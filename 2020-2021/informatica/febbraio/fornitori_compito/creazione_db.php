<!DOCTYPE html>
<html lang="it">
<head>
<title>Creazione DB</title>
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

include("./parametri.php");

echo $db_host;

$connessione = new mysqli($db_host,$db_user,$db_pass);
if ($connessione->connect_errno) 
    {
    echo "Connessione fallita: ". $connessione->connect_error . ".";
    exit();
    }

$query="CREATE DATABASE ".$db_name." CHARACTER SET = 'utf8' COLLATE = 'utf8_unicode_ci';";


echo "Eseguo query: <pre><code class=\"language-sql\">$query</code></pre>";

$ris = $connessione->query($query);
if ($ris == false) 
    {
    echo "<p style='color: red;'>Errore della query: " . htmlspecialchars($connessione->error) . ".</p>";
    }
else{
    echo "<p style='color: darkseagreen;'>Database $db_name creato correttamente.</p>";
    }


$connessione->close();

?>
<p><a href="index.php"><-- Ritorna alla pagina principale</a></p>
</main>
<script type="text/javascript" src="prism.js"></script>
</body>
</html>