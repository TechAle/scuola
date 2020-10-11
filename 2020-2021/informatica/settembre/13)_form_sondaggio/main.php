<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>pag</title>
</head>
<body>
<form action="" method="post">
    <label>
        Nome:
        <input type="text" pattern="[a-zA-Z]{}" maxlength="40" name="cognome"/><br>
    </label> <!-- cognome -->
    <label>
        Email:
        <input type="text" pattern="[a-zA-Z]{}" maxlength="40" name="nome"/>
    </label> <!-- nome -->
    <label>
        <div>Come hai conosciuto il sito:</div>
        <input type="checkbox" name="hobby[]" value="Motore di ricerca">Motore di ricerca<br>
        <input type="checkbox" name="hobby[]" value="Prof">Il prof me l'ha fatto fare
    </label> <!-- hobby -->
    <label>
        <div>Come giudichi questo sito:</div>
        <input type="radio" name="sesso" value="Orribile">Orribile<br>
        <input type="radio" name="sesso" value="Pessimo">Pessimoh
    </label> <!-- sesso -->
    <label>
        <div>Commento:</div>
        <!-- E dovrei fare un javascript per le righe e colonne? -->
        <textarea name="commento" style="height: 100px">

            </textarea>
    </label> <!-- commento -->
    <label>
        <div>Come giudichi questo sito:</div>
        <input type="radio" name="eta" value="0-20">0-20<br>
        <input type="radio" name="eta" value="21-100">21-100
    </label> <!-- sesso -->
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
    $sesso = $_POST["sesso"];
    $hobby[0] = $_POST["hobby"];
    $commento = $_POST["commento"];

    $output =   "lol php è semplice<br>" .
        "Cognome: " . $cognome .
        "<br>Email: ". $nome . "<br>" .
        "Giudizio: " . $sesso . "<br>" .
        "commento:" . $commento . "<br>" .
        "Come hai trovato il sito: ";
    foreach ($hobby[0] as $scelte) {
        $output .= $scelte . ' ';
    }
}

?>
<?php echo $output; ?>
</body>
</html>