<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>pag</title>
</head>
<body>
<form action="" method="post">
    <label>
        <div>Nome:</div>
        <input type="text" name="nome"/>
    </label> <!-- nome -->
    <label>
        <div>Sesso:</div>
        <select name="sessox">
            <option value="maschio">maschio</option>
            <option value="femmina">femmina</option>
        </select>
    </label> <!-- sesso -->
    <label>
        <div>Dati personali:</div>
        <input type="radio" name="dati" value="si">si<br>
        <input type="radio" name="dati" value="no">no
    </label> <!-- dati -->
    <label>
        <div>Programmazione:</div>
        <input type="checkbox" name="programmazione[]" value="c">C<br>
        <input type="checkbox" name="programmazione[]" value="c#">C#
    </label> <!-- programmazione -->
    <div>
        <input type="submit" name="invia">
        <input type="reset" name="azzera">
    </div> <!-- invio + reset -->
</form>

<?php
$output = "";
if (isset($_POST["invia"])) {
    $nome = $_POST["nome"];
    $dati = $_POST["paese"];
    $sesso = $_POST["sessox"];
    $programmazione = $_POST["programmazione"];

    $output = " Nome: " . $nome . "<br>" . " Sesso: " . $sesso . "<br>" .
        "dati: " . $dati . " Linguaggi: ";

    foreach ($programmazione as $prog) {
        $output .= $prog . ' ';
    }
}

?>
<?php echo $output; ?>
</body>
</html
