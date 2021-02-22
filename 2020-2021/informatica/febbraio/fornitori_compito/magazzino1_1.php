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
        Elenco dei prodotti con nome, reparto, sconto, costo acquisto, prezzo di vendita, giacenza e valore prodotto ordinato per nome prodotto e nome reparto
    </div>
    <br>
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
    reparto,
    articolo as "prodotto",
    sconto,
    costo as "costo acquisto",
    prezzovendita as "prezzo vendita",
    giacenza,
    costo * giacenza as "valore prodotto"
    from tbarticoli, tbacquisti, tbreparti
    where tbarticoli.idarticolo = tbacquisti.ksarticolo and tbreparti.idreparto = tbarticoli.ksreparto
    order by reparto, articolo
    SQL;

    visualizza_tabella($query,$connessione,$visualizzaQuery);
    $connessione->close();

    ?>
    <p><a href="index.php"><-- Ritorna alla pagina principale</a></p>
</main>
<script type="text/javascript" src="prism.js"></script>
</body>
</html>
