<!DOCTYPE html>
<html lang="it">
<head>
<title>Visualizzazione query generica</title>
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
Visualizzare il numero di dipendenti provenienti da una determinata provincia (scelta con menù a tendina)
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
<p>Seleziona parametro</p>

<form  action=<?php echo $_SERVER['PHP_SELF']; ?> method='post'>
<div class="form-group">
    <label for="Parametro">Parametro</label>
    <select name="Parametro" id="Parametro" required>
<?php
$funzioni=ritorna_array("SELECT DISTINCT Prov FROM Personale",$connessione);
foreach($funzioni as $Parametro)
    echo "<option value=\"$Parametro\">$Parametro</option>";
?>
</select>
  </div>
<br>
 <input type='submit'  name='submit' value='esegui query'></form>
 <br>
<?php 
if (isset($_POST['submit'])) 
    {
    $Parametro=$connessione->real_escape_string($_POST["Parametro"]);  
    $query=<<<SQL
        SELECT COUNT(*) as "Numerosità personale"
        FROM personale 
        WHERE Prov='$Parametro'
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