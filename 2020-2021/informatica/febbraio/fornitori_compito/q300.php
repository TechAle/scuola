<!DOCTYPE html>
<html lang="it">
<head>
<title>Ricerca per cognome</title>
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
Ricerca per cognome
</div>
<br>
<form  action=<?php echo $_SERVER['PHP_SELF']; ?> method='post'>
<div class="form-group">
    <label for="Cognome">Cognome</label>
    <input type="text" name="Cognome" class="form-control" id="Cognome" value="Rossi" maxlength="20" required>
  </div>
<br>
 <input type='submit'  name='submit' value='esegui query'></form>
 <br>
<?php 
if (isset($_POST['submit'])) 
    {
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
    $Cognome=$connessione->real_escape_string($_POST["Cognome"]);
    //$query="SELECT * FROM personale where Cognome LIKE \"%$Cognome%\"";
    $query=<<<SQL
        SELECT * 
        FROM personale
        WHERE Cognome LIKE "%$Cognome%"
    SQL;
    //disabilita operazioni critiche
    $query = str_replace(array("delete","drop","update","alter"),array('','','',''),strtolower($query));
    visualizza_tabella($query,$connessione,$visualizzaQuery);
    $connessione->close();     
} 
?>
<p><a href="index.php"><-- Ritorna alla pagina principale</a></p>
</main>
<script type="text/javascript" src="prism.js"></script>
</body>
</html>