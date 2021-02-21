<!DOCTYPE html>
<html lang="it">
<head>
<title>Visualizza il personale di determinate province</title>
  <meta charset="UTF-8"/>
        <link rel="stylesheet" href="rsc/css/bootstrap.min.css"/>
        <style type="text/css">
            body {
                padding-top: 5vh;
            }
        </style>
        <link rel="stylesheet" href="prism.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<script>
function submitForm() 
    {
    var form = document.formProv;
    var dataString = $(form).serialize();
    $.ajax(
            {
            type:'POST',
            url:'q202a.php',
            data: dataString,
            success: function(data)
                {
                $('#myResponse').html(data);
                }
            });
    return false;
    }
</script>
<body>
<main role="main" class="container">
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
<p>Visualizza il personale di determinate province</p>
<form  name= "formProv"  method='POST'>
<div class="form-group">
<?php
$province=ritorna_array("SELECT DISTINCT Prov AS Provincia FROM personale ORDER BY Provincia",$connessione);
foreach($province as $provincia)
    {
    echo "<input type=\"checkbox\" id=\"$provincia\" name=\"prov[]\" value=\"$provincia\" > ";
    echo "<label for=\"$provincia\">$provincia</label><br>";
    }
?>
</div>
<br>
<input type='submit'  name='submit' value='esegui query' onclick="return submitForm()"></form>
<div id="myResponse"></div>
<p><a href="index.php"><-- Ritorna alla pagina principale</a></p>
</main>
<script type="text/javascript" src="prism.js"></script>
</body>
</html>