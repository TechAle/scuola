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
Elenco dei dipendenti (Cognome, Nome, Funzione,Data assunzione) assunti tra due date
</div>
<br>



<form  action=<?php echo $_SERVER['PHP_SELF']; ?> method='post'>

<div class="form-group">
    <label for="data1">Data 1</label>
    <input type="date" name="data1" class="form-control" id="data1" value="2010-01-15" required>
  </div>
  <div class="form-group">
    <label for="data2">Data 2</label>
    <input type="date" name="data2" class="form-control" id="data2" value="2012-05-20"  required>
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

        $data1=$connessione->real_escape_string($_POST["data1"]);
        $data2=$connessione->real_escape_string($_POST["data2"]);
        $query=<<<SQL
        SELECT Cognome,Nome,Funzione, Assunto AS "DATA ASSUNZIONE"
        FROM personale
        WHERE Assunto BETWEEN "$data1" AND "$data2";
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