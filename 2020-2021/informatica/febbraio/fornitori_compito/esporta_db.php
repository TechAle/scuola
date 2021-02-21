<!DOCTYPE html>
<html lang="it">
<head>
<title>Esporta DB</title>
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
// https://phppot.com/php/how-to-backup-mysql-database-using-php/

//inclusione parametri
include("./parametri.php");

//connessione al DBMS
$connessione = new mysqli($db_host,$db_user,$db_pass);
if ($connessione->connect_errno) 
    {
    echo "Connessione fallita: ". $connessione->connect_error . ".";
    exit();
    }
$connessione->set_charset("utf8");
$connessione->select_db($db_name);
if ($connessione->connect_errno) 
    {
    echo "<p style='color: red;'>Errore di connessione al database: " . htmlspecialchars($connessione->connect_error) . "</p>";
    exit();
    }

// elenco tabelle del DB
$tabelle = array();
$sql = "SHOW TABLES";
$result = $connessione->query($sql);
if ($result == false) 
    {
    echo "<p style='color: red;'>Errore della query: " . htmlspecialchars($connessione->error) . ".</p>";
    }
else
    {
    while ($row = $result->fetch_row()) 
        {
        $tabelle[] = $row[0];
        }
    $sqlScript = "";
    foreach ($tabelle as $tabella) 
        {  
        $query = "SHOW CREATE TABLE $tabella";
        $result = $connessione->query($query);
        $row = $result->fetch_row();   
        $sqlScript .= "\n\n" . $row[1] . ";\n\n";
        $query = "SELECT * FROM $tabella";
        $result = $connessione->query($query);
        $numeroColonne = $result->field_count;
        for ($i = 0; $i < $numeroColonne; $i ++) 
            {
            while ($row = $result->fetch_row()) 
                {
                $sqlScript .= "INSERT INTO $tabella VALUES(";
                for ($j = 0; $j < $numeroColonne; $j ++) 
                    {
                    //$row[$j] = $row[$j];  
                    if (isset($row[$j])) 
                        {
                        $sqlScript .= '"' . $row[$j] . '"';
                        } 
                    else 
                        {
                        $sqlScript .= '""';
                        }
                    if ($j < ($numeroColonne - 1)) 
                        {
                        $sqlScript .= ',';
                        }
                    }
                $sqlScript .= ");\n";
                }
            }
        $sqlScript .= "\n"; 
        }
    if(!empty($sqlScript))
        {
        // Salvataggio su file di backup
        $backupFile = $db_name . '_backup_' . time() . '.sql';
        $f = fopen($backupFile, 'w+');
        $numeroRighe = fwrite($f, $sqlScript);
        fclose($f); 

        // Download del file di backup
        header('Content-Description: Backup file');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($backupFile));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($backupFile));
        ob_clean();
        flush();
        readfile($backupFile);
        unlink($backupFile);
        }
    else    
        echo "<p style='color: red;'>Il database $db_name è vuoto!</p>";
    }
$connessione->close();
?>
<p><a href="index.php"><-- Ritorna alla pagina principale</a></p>
</main>
<script type="text/javascript" src="prism.js"></script>
</body>
</html>