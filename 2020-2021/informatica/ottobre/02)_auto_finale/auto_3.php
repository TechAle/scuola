<?php
$nome = $_GET["nome"];
$cogmone = $_GET["cognome"];
$data_ritiro = $_GET["data_ritiro"];
$macchina = $_GET["macchina"];
$giorni = $_GET["giorni"];
echo sprintf("<fieldset>Gent, Sig. %s %s la sua prenotazione per il giorno %s<br>" .
             "Al momento del ritiro dovra’ saldare un conto di %s euro per %s giorni di noleggio<br>" .
             "<b>(La tariffa comprende il supplemento assicurativo)</b>.<br>La aspettiamo!!!</fieldset>" ,
             $nome, $cogmone, $data_ritiro, $macchina, $giorni);