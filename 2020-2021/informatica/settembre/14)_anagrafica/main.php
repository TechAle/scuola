<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>pag</title>
</head>
<body>
<form action="" method="post">
    <label>
        NOME:
        <input type="text" pattern="[A-Z][a-z]{}" name="nome"/><br>
    </label> <!-- nome -->
    <label>
        Cognome:
        <input type="text" pattern="[A-Z][a-z]{}" name="cognome"/><br>
    </label> <!-- cognome -->
    <label>
        Codice fiscale:
        <input type="text" pattern="[A-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]" name="codice_fiscale"/><br>
    </label> <!-- codice fiscale -->
    <label>
        Citta:
        <input type="text" pattern="[A-Z][a-z]{}" name="citta"/><br>
    </label> <!-- citta -->
    <label>
        Via:
        <input type="text" pattern="[A-Z a-z 0-9]{,25}" name="via"/><br>
    </label> <!-- via -->
    <label>
        Numero civico:
        <input type="text" pattern="[0-9]{}" name="civico"/><br>
    </label> <!-- civico -->
    <label>
        Patente:
        <input type="text" pattern="[A-Z][0-9][A-Z][0-9]{6}[A-Z]" name="patente"/><br>
    </label> <!-- patente -->
    <label>
        CI:
        <input type="text" pattern="[A-Z]{2}[0-9]{7}" name="CI"/><br>
    </label> <!-- CI -->
    <div>
        <input type="submit" name="invia">
        <input type="reset" name="AZZERAH">
    </div> <!-- invio + reset -->
</form>

<?php
$output = "";
if (isset($_POST["invia"])) {
    $cognome = $_POST["cognome"];
    $nome = $_POST["nome"];
    $codice = $_POST["codice"];
    $citta = $_POST["citta"];
    $via = $_POST["via"];
    $patente = $_POST["patente"];
    $CI = $_POST["CI"];
    $output =   "Cognome: " . $cognome . " Nome: " . $nome . "<br>" .
                "Codice: " . $codice . " via: " . $via . "<br>" .
                "patente: " . $patente . " CI: " . $CI;
}
?>
<?php echo $output; ?>
</body>
</html>