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
?>
<script type="text/javascript" src="prism.js"></script>
