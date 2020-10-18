<html lang="it">

<head>

    <title>Meteo</title>

</head>

<body>
    <?php
        echo "Citta:<br>";
        $f=fopen("meteo.txt","r") or die ("Errore apertura file auto.txt...");
        $output = "";
        while($s=fgets($f)) {
            $v = explode(";", $s)[0];
            echo sprintf("<a href='./meteo_citta.php?citta=%s'>%s</a><br>", $v, $v);
        }
    echo $output;
        fclose($f); ?>
</body>

</html>