<!--
Visualizzare Cognome,Nome e codicefiscale, stipendio attuale e nuovo stipendio aumentato del 5%
-->
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Visualizzazione query</title>
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
tutti i prodotti con costo acquisto minore    <br>
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

    $query=<<<SQL
    select 
    articolo as "prodotto",
    giacenza,
    costo as "costo acquisto"
    from tbarticoli, tbacquisti
    where   tbarticoli.idarticolo = tbacquisti.ksarticolo and costo = ( select min(costo) from tbacquisti )   
    SQL;

    visualizza_tabella($query,$connessione,$visualizzaQuery);
    $connessione->close();

    ?>
    <p><a href="index.php"><-- Ritorna alla pagina principale</a></p>
</main>
<script type="text/javascript" src="prism.js"></script>
</body>
</html>
