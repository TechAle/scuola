<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>auto</title>
</head>
<body style="height: 100vh; width: 100vw">
<form action="" method="post">
    <center style="padding-top: 10vh">
    <fieldset style="width: 100px; text-align: center;">
        Nome: <input type="text" name="nome" required /><br>
        Costo: <input type="text" name="costo" required />
        <input type="submit" name="invia">
    </fieldset>
    </center>
</form>

<?php
    $output = "";
    if (isset($_POST["invia"])) {

        $nome = $_POST["nome"];
        $costo = $_POST["costo"];
        $riga="$nome;$costo";
        $f=fopen("elenco.txt","a") or die ("Errore nell'apertura del elenco.txt...");
        fputs($f, "\n" . $riga);
        fclose($f);
        $output = "Riga ".$riga. " scritta nel file elenco.txt";
    }

?>

<?php echo $output ?>
</body>
</html>
