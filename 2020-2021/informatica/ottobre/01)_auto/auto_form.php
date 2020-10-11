<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>auto</title>
</head>
<body>
    <form action="" method="post">
        <fieldset>
            <legend>SCELTA AUTO</legend>
        Scegli una macchina<br/>
        Data di ritiro <input type="date" name="data_ritiro"/><br/>
        <?php

        $f=fopen("elenco.txt","r") or die ("Errore apertura file elenco.txt...");

        while($s=fgets($f)) {
            $v = explode(";", $s);

            $output = '<input type="radio" name="macchina" value=" ' . $v[1]. ' "/>' . $v[0] . ' ($' . $v[1] . ')<br/>';
        }
        fclose($f);


        echo $output ?>
        (elenco dinamico di radio in base ai dati di file)
        </fieldset>
        <fieldset>
            <legend>DATI</legend>
            Cognome<br><input type="text" name="cognome" required><br/>
            Nome<br><input type="text" name="nome" required><br/>
            Numero giorni<br><input type="number"  name="giorni"><br>
            Anni Conducente<br><input type="number" name="anni"><br>
        </fieldset>

        <input type="submit" name="invia">

    </form>

    <?php
    $output_fin = "";
    if (isset($_POST["invia"])) {

        $data_ritiro = $_GET['data_ritiro'];
        $macchina = $_GET['macchina'];
        $cognome = $_GET['cognome'];
        $nome = $_GET['nome'];
        $giorni = $_GET['giorni'];
        $anni = $_GET['anni'];

        $costo = $macchina * $giorni;
        if ($giorni > 3)
            $costo = $costo - (5 * $giorni);

        if ($anni < 25)
            $costo = $costo + 12.50;


        echo "Gent, Sig.$cognome $nome la sua prenotazione per il giorno $data_ritiro e’ stata accettata.
Al momento del ritiro dovra’ saldare un conto di euro $costo per $giorni di noleggio.<br/><b>(La tariffa comprende il supplemento assicurativo).</b>";
    }

    ?>


    <?php
        echo $output_fin;
    ?>
</body>
</html>