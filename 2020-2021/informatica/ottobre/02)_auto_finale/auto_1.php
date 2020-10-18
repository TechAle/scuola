<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>auto</title>
</head>
<body>
<form action="auto_2.php" method="get">
    <fieldset>
        SCELTA AUTO <br/>
        Data di ritiro <input type="date" name="data_ritiro"/><br/>
        <?php

        $f=fopen("auto.txt","r") or die ("Errore apertura file auto.txt...");

        while($s=fgets($f)) {
            $v = explode(";", $s);

            $output .= '<input type="radio" name="macchina" value=" ' . $v[1]. ' "/>' . $v[0] . ' ($' . $v[1] . ')<br/>';
        }
        fclose($f);


        echo $output ?>
        <input type="submit" name="invia">
    </fieldset>


</form>

</body>
</html>