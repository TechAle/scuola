<!DOCTYPE html>
<html lang="it">
<head>
<title>Visualizza il Cognome, il Nome e il codice fiscale del personale si una data funzione</title>
  <meta charset="UTF-8"/>
        <link rel="stylesheet" href="rsc/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="rsc/css/stili.css"/>
        <style type="text/css">
            body {
                padding-top: 5vh;
            }
        </style>
        <link rel="stylesheet" href="prism.css"/>
</head>
<body>
<main role="main" class="container">
<div class="testoQuery" >
Visualizza il Cognome, il Nome e il codice fiscale del personale si una data funzione
</div>
<br>
<?php
require_once("parametri.php");   
require_once("libreria.php"); 
$connessione = new mysqli($db_host,$db_user,$db_pass);
if ($connessione->connect_errno) 
    {
    echo "<p style='color: red;'>Errore di connessione al database: " . htmlspecialchars($connessione->connect_error) . "</p>";
    exit();
    }       
$connessione->select_db($db_name);  
?>
<form  action=<?php echo $_SERVER['PHP_SELF']; ?> method='post'>
<div class="form-group">
    <label for="Funzione">Funzione</label>
    <select name="Funzione" id="Funzione" required>
<?php
$funzioni=ritorna_array("SELECT DISTINCT Funzione FROM Personale",$connessione);
foreach($funzioni as $funzione)
    echo "<option value=\"$funzione\">$funzione</option>";
?>
</select>
</div>
<br>
 <input type='submit'  name='submit' value='esegui query'></form>
 <br>
<?php 
if (isset($_POST['submit'])) 
    {
    $Funzione=$connessione->real_escape_string($_POST["Funzione"]);
    //$query="SELECT * FROM personale where ";   
    $query=<<<SQL
        SELECT * 
        FROM personale
        WHERE Funzione="$Funzione";
    SQL;
    visualizza_tabella($query,$connessione,$visualizzaQuery);
    $connessione->close();     
    } 
?>
<p><a href="index.php"><-- Ritorna alla pagina principale</a></p>
</main>
<script type="text/javascript" src="prism.js"></script>
</body>
</html>