<!DOCTYPE html>
<html lang="it">
<head>
<title>Importazione DB</title>
  <meta charset="UTF-8"/>
        <link rel="stylesheet" href="rsc/css/bootstrap.min.css"/>
        <style type="text/css">
            body {
                padding-top: 5vh;
            }
        </style>
        <link rel="stylesheet" href="prism.css"/>
    <style>

	.sql-import-response {
		padding: 10px;
	}
	.success-response {
		background-color: #a8ebc4;
	    border-color: #1b7943;
	    color: #1b7943;
	}
	.error-response {
		border-color: #d96557;
    	background: #f0c4bf;
    	color: #d96557;
	}
</style>
</head>
<body>
<main role="main" class="container">

<?php 
$carica=false;
//Upload File
if (isset($_POST['submit'])) 
    {
    if (is_uploaded_file($_FILES['filename']['tmp_name'])) 
        {
        echo $_FILES['filename']['type'];
        if($_FILES['filename']['type'] == "application/octet-stream")
            {
            echo "<h1>" . "File ". $_FILES['filename']['name'] ." upload concluso con successo." . "</h1>";
            echo "<h2>Contenuto file:</h2>";
            echo "<hr>";
            echo nl2br(file_get_contents($_FILES['filename']['tmp_name']));
            echo "<hr><br>";
            $carica=true;
            }
        else    
            echo "Il file caricato non è un file csv!";
        }
    } 
else 
    {
    ?>
    Selezionare file da importare (IL DB deve esistere!)<br />
    <form enctype='multipart/form-data' action=<?php echo $_SERVER['PHP_SELF']; ?> method='post'>
    Fila da caricare:<br />
    <input size='50' type='file' name='filename' accept=".sql"><br />
    <input type='submit' name='submit' value='Upload'></form>
    <?php
    }
if($carica==true)
    {
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
    $nomef=$_FILES['filename']['tmp_name'];
    $query = '';
    $sqlScript = file($nomef);
    foreach ($sqlScript as $line)	
        {   
        $startWith = substr(trim($line), 0 ,2);
        $endWith = substr(trim($line), -1 ,1);     
        if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') 
            {
            continue;
            }
        $query = $query . $line;
        if ($endWith == ';') 
            {
            $connessione->query($query) or die('<div class="error-response sql-import-response">Errore esecuzione della query <b>' . $query. "</b><br>Errore: ". htmlspecialchars($connessione->error)."</div>");
            $query= '';		
            }
        }
    echo '<div class="success-response sql-import-response">File importato con successo</div>';     
    $connessione->close();
    }
?>
<p><a href="index.php"><-- Ritorna alla pagina principale</a></p>
</main>
<script type="text/javascript" src="prism.js"></script>
</body>
</html>