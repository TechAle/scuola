<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>auto</title>
</head>

<body>
<form action="auto_3.php" method="get">
<fieldset>
    <legend>DATI</legend>
    Cognome<br><input type="text" name="cognome" required><br/>
    Nome<br><input type="text" name="nome" required><br/>
    Numero giorni<br><input type="number"  name="giorni"><br>
    Anni Conducente<br><input type="number" name="anni"><br>
    <input type="hidden" name="data_ritiro" value="<?php echo $_GET["data_ritiro"]?>">
    <input type="hidden" name="macchina" value="<?php echo $_GET["macchina"]?>">
    <input type="submit" name="invia">
</fieldset>
</form>
</body>

</html>