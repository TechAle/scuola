<!DOCTYPE html>
<html lang="it">
<head>
<title>Visualizzazione query generica</title>
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
<form  action=<?php echo $_SERVER['PHP_SELF']; ?> method='post'>
Query da eseguire:<br />
<textarea class="form-control" rows="3" name="query" style="height: 100px"><?php
    if (isset($_POST['submit'])) {
        $query=$_POST["query"];
        $query = str_replace(array("delete","drop","update","alter"),array('','','',''),strtolower($query));
        echo $query;
    }else echo "SELECT * FROM personale"
    ?></textarea>
<br>
 <input type='submit'  name='submit' value='esegui query'></form>
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
    $query=$_POST["query"];
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