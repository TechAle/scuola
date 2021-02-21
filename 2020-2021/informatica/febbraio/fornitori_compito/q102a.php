<?php 
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
    $Funzione=$connessione->real_escape_string($_GET["Funzione"]);
   // $query="SELECT * FROM personale where Funzione=\"$Funzione\"";
   $query=<<<SQL
        SELECT * 
        FROM personale
        WHERE Funzione="$Funzione";
    SQL;
    visualizza_tabella($query,$connessione,$visualizzaQuery);
?>
<script type="text/javascript" src="prism.js"></script>