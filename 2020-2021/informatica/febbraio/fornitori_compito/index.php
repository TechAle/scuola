<!DOCTYPE html>
<html lang="it">
<head>
<title>MAGAZZINO</title>
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

<h1>PERSONALE</h1>
<ul>
    <li>Documentazione</li>
    <ul>
        <li><a href="./doc/schema.png">Schema DB</a></li>
    </ul>
</ul>

<ul>
    <li>Operazioni combinate</li>
    <ul>
        <li><a href="creazione_db.php">Creazione database</a></li>
        <li><a href="cancellazione_tabelle.php">Cancellazione tabelle</a></li>
        <li><a href="creazione_tabelle.php">Creazione tabelle</a></li>
        <li><a href="creazione_vincoli.php">Creazione vincoli</a></li>
        <li><a href="svuota_tabelle.php">Svuota_tabelle</a></li>
        <li><a href="popola_tabelle.php">Popola tabelle</a></li>
    </ul>
</ul>

<ul>
    <li>Informazioni database</li>
    <ul>
    <li><a href="info.php">Informazioni database</a></li>
 
    </ul>
</ul>

<ul>
    <li>Esporta/importa</li>
    <ul>
    <li><a href="esporta_db.php">Esporta database</a></li>
    <li><a href="importa_db.php">Importa database</a></li>
    </ul>
</ul>

<ul>
    <li>Visualizza contentuto tabelle</li>
    <ul>
        <li><a href="visualizza_fornitori.php">Fornitori</a></li>
        <li><a href="visualizza_acquisti.php">Acquisti</a></li>
        <li><a href="visualizza_articoli.php">Articoli</a></li>
        <li><a href="visualizza_reparti.php">Reparti</a></li>
        <li><a href="visualizza_categorie.php">Categorie</a></li>

    </ul>
</ul>

<ul>
    <li>Query libera</li>
    <ul>
    <li><a href="query_libera.php">Query libera</a></li>
    </ul>
</ul>

<ul>
    <li>Query</li>
    <ul>
    <li>Selezione senza input</li>
        <ul>
        <li><a href="q008.php">Visualizzare l'elenco delle diverse province di residenza del personale</a></li>
        <li><a href="q009.php">Visualizzare l'elenco delle diverse funzioni del personale</a></li>
        <li><a href="q007.php">Visualizzare Congnome,Nome e codicefiscale, stipendio attuale e nuovo stipendio aumentato del 5%</a></li>
        <li><a href="q010.php">Visualizzare il personale(matricola, cognome, nome, descrizione filiale ed indirizzo filiale) ordinati per Cognome</a></li>
        </ul>
    <li>Query parametriche</li>
        <ul>
        <li><a href="q100.php">Cognome, Nome e codice fiscale di una data funzione</a></li>
        <li><a href="q101.php">Cognome, Nome e codice fiscale di una data funzione (con menu a tendina)</a></li>
        <li><a href="q102.php">Cognome, Nome e codice fiscale di una data funzione (con menu a tendina e ajax -get)</a></li>
        <li><a href="q103.php">Cognome, Nome e codice fiscale di una data funzione (con menu a tendina (ajax-jquery))</a></li>
        </ul>
    <li>Count</li>
        <ul>
        <li><a href="q015.php">Visualizzare il numero dei record presenti nella tabella personale</a></li>
        <li><a href="q016.php">Visualizzare il numero di province diverse presenti nella tabella personale</a></li>
        <li><a href="q017.php">Visualizzare il numero di dipendenti provenienti da una determinata provincia (scelta con menù a tendina)</a></li>
        <li><a href="q018.php">Visualizzare il numero di livelli diversi a cui appargono i dipendenti di una determinata provincia(scelta con menù a tendina)</a></li>
        </ul>
    <li>SUM</li>
        <ul>
        <li><a href="q020.php">Visualizzare la somma di tutti gli stipendi</a></li>
        <li><a href="q021.php">Visualizzare  al somma di tutti gli stipendi di una determinata filiale (scelta con menù a tendina)</a></li>
        </ul>
    <li>AVG</li>
        <ul>
        <li><a href="q030.php">Visualizzare la media di tutti gli stipendi</a></li>
        <li><a href="q031.php">Visualizzare la media di tutti gli stipendi di una determinata filiale (scelta con menù a tendina)</a></li>       
        </ul>
    <li>MIN e MAX</li>
        <ul>
        <li><a href="q040.php">Stipendio massimo e minimo di tutti i dipendenti</a></li>
        <li><a href="q041.php">Primo e ultimo cognome dell'elenco dei dipendenti </a></li>       
        </ul>
    <li>ORDER BY</li>
        <ul>
        <li><a href="q200.php">Visualizzazione province di provenienza in ordine alfabetico</a></li>
        <li><a href="q050.php">Elenco alfabetico dei dipendenti, con cognome, nome, codice fiscale e data di assunzione</a></li>
        <li><a href="q051.php">Elenco dei dipendenti in ordine decrescente di stipendio base e , a parità di stipendio, in ordine di cognome </a></li>       
        </ul>
    <li>GROUP BY</li>
        <ul>
        <li><a href="q060.php">Lista delle funzioni dei dipendenti con la somma degli stipendi e il numero dei dipendenti appartenenti alle diverse funzioni</a></li>
        <li><a href="q061.php">Elenco dei livelli esistenti tra i dipendenti che svolgono la funzione di "Impiegato" con il numero di dipendenti per ciascun livello </a></li>       
        </ul>
    <li>HAVING</li>
        <ul>
        <li><a href="q070.php">Lista delle funzioni dei dipendenti con lo stupendio medio per ciascuna funzione, dopo aver raggruppato i dipendenti per funzione, purchè i dipendenti con quella funzione siano più di 2</a></li>
        <li><a href="q071.php">Elenco delle filiali nelle quali ci sono più di 3 impiegati</a></li> 
        <li><a href="q072.php">Elenco delle filiali (descrizione) nelle quali ci sono più di 3 impiegati</a></li>           
        </ul>
    <li>BETWEEN</li>
        <ul>
        <li><a href="q080.php">Elenco dei dipendenti (Cognome, Nome, Funzione,Data assunzione) assunti tra due date</a></li>  
        <li><a href="q081.php">Elenco dei dipendenti (Cognome, Nome, Funzione,Data assunzione) assunti dopo una certa data</a></li>           
        </ul>
    <li>IN</li>
        <ul>
        <li><a href="q201.php">Visualizza personale di un insieme di province</a></li>
        <li><a href="q202.php">Visualizza personale di un insieme di province con bottone(ajax-jquery)</a></li>    
        <li><a href="q203.php">Visualizza personale di un insieme di province con evento change checkbox(ajax-jquery)</a></li>     
        </ul>
    <li>LIKE</li>
        <ul>
        <li><a href="q300.php">Ricerca per cognome LIKE</a></li>
        <li><a href="q301.php">Ricerca per cognome LIKE (ajax-jquery)</a></li>         
        </ul>  
    <li>SELECT NIDIFICATE</li>
        <ul>
        <li><a href="q400.php">Elenco con cognome e nome dei dipendenti che hanno lo stipendio base inferiore allo stipendio medio di tutti i dipendenti</a></li>
        <li><a href="q405.php">Elenco con cognome, nome, descrizione filiale (in ordine alfabetico di Cognome, Nome) dei dipendenti con lo stipendio maggiore al valore massimo tra tutti gli stipendi dei dipendenti con la funzione di impiegato</a></li> 
        <li><a href="q410.php">[ANY] Elenco con cognome, nome, funzione dei dipendenti che non sono impiegati e che hanno lo stipendio inferiore a quello di uno qualsiasi tra gli impiegati</a></li>                 
        <li><a href="q415.php">[ALL] Elenco con cognome, nome, funzione dei dipendenti che non sono impiegati e che hanno lo stipendio inferiore a quello di tutti gli impiegati</a></li>  
        <li><a href="q420.php">[IN] Elenco con Cognome e nome dei dipendenti che lavorano nelle filiali che hanno più di 10 dipendenti</a></li> 
        <li><a href="q425.php">[EXISTS] Elenco dei dipendenti con cognome e nome solo se esistono dipendenti di sesto livello</a></li>              
        </ul>  
    </ul>
</ul>
</main>
</body>
</html>