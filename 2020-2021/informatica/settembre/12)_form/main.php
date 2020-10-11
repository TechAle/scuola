<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>pag</title>
</head>
<body>
    <form action="" method="post">
        <label>
            <div>Cognome:</div>
            <input type="text" pattern="[A-Za-z]" maxlength="5" name="cognome"/>
        </label> <!-- cognome -->
        <label>
            <div>Nome:</div>
            <input type="text" pattern="[A-Za-z]" maxlength="5" name="nome"/>
        </label> <!-- nome -->
        <label>
            <div>Paese:</div>
            <select name="paese">
                <option value="italia">italia</option>
                <option value="francia">francia</option>
            </select>
        </label> <!-- paese -->
        <label>
            <div>Sesso:</div>
            <input type="radio" name="sesso" value="m">m<br>
            <input type="radio" name="sesso" value="f">f
        </label> <!-- sesso -->
        <label>
            <div>Hobby:</div>
            <input type="checkbox" name="hobby" value="Sport">Sport<br>
            <input type="checkbox" name="hobby" value="Internet">Internet
        </label> <!-- hobby -->
        <label>
            <div>Commento:</div>
            <textarea name="commento" style="height: 100px">

            </textarea>
        </label> <!-- commento -->
        <div>
            <input type="submit" name="invia">
            <input type="reset" name="azzera">
        </div> <!-- invio + reset -->
    </form>

    <?php
        $output = "";
        if (isset($_POST["invia"])) {
            $cognome = $_POST["cognome"];
            $nome = $_POST["nome"];
            $paese = $_POST["paese"];
            $sesso = $_POST["sesso"];
            $hobby = $_POST["hobby"];
            $commento = $_POST["commento"];

            $output =   "lol php è semplice<br>" .
                        "Cognome: " . $cognome . " Nome: " . $nome . "<br>" .
                        "Paese: " . $paese . " Sesso: " . $sesso . "<br>" .
                        "Hobby: " . $hobby . "<br>" . " commento:<br>" .
                        $hobby;
        }

    ?>
    <?php echo $output; ?>
</body>
</html>