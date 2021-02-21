
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
    visualizza_tabella($query,$connessione,$visualizzaQuery);    
    }
else   
    echo "<p style='color: red;'>Nessuna provincia selezionata</p>";

?>
<script type="text/javascript" src="prism.js"></script>
