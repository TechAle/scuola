<!DOCTYPE html>
<html lang="it">
<head>
<title>Personale in determinate province</title>
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
Visualizza il personale di determinate province
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
<form  action=<?php echo $_SERVER['PHP_SELF']; ?> method='POST'>
<div class="form-group">
<?php
$province=ritorna_array("SELECT DISTINCT Prov AS Provincia FROM personale ORDER BY Provincia",$connessione);
foreach($province as $provincia)
    {
    echo "<input type=\"checkbox\" id=\"$provincia\" name=\"prov[]\" value=\"$provincia\"> ";
    echo "<label for=\"$provincia\">$provincia</label><br>";
    }

?>
  </div>
<br>
 <input type='submit'  name='submit' value='esegui query'></form>
 <br>
<?php 
if (isset($_POST['submit'])) 
    {
    if (isset($_POST['prov'])) 
        {
        $prov = $_POST['prov']; 
        $n = count($prov); 
        $province="";
        print("Hai selezionato $n province: <br>");
    for ($i=0; $i < $n; $i++)
            if($i!=0)
                $province.=",'".$prov[$i]."'";
            else
            $province.="'".$prov[$i]."'";
        print($province . "<br>");  
        $query=<<<SQL
        SELECT *
        FROM personale
        WHERE Prov IN ($province);
        SQL;
       // $query="SELECT * FROM personale where Prov IN ($province)";
       visualizza_tabella($query,$connessione,$visualizzaQuery);        
    }
    else   
        echo "<p style='color: red;'>Nessuna provincia selezionata</p>";
    $connessione->close();      
    } 
?>
<p><a href="index.php"><-- Ritorna alla pagina principale</a></p>
</main>
<script type="text/javascript" src="prism.js"></script>
</body>
</html>