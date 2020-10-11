<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>pag</title>
    <style>
        form {
            background-color: #acff95;
            width: 30%;
        }
        input {
            background-color: white;
            outline-color: #82f682;
        }
    </style>
</head>
<body>
<form action="" method="post">
    <label>
        NOME:
        <!-- <input type="text" pattern="[A-Z][a-z]{}" name="nome"/><br> -->
        <input type="text"name="nome"/><br>
    </label> <!-- nome -->
    <label>
        Cognome:
        <!--<input type="text" pattern="[A-Z][a-z]{}" name="cognome"/><br>-->
        <input type="text" name="cognome"/><br>
    </label> <!-- cognome -->
    <label>
        Codice fiscale:
        <!--<input type="text" pattern="[A-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]" name="codice_fiscale"/><br>-->
        <input type="text" name="codice_fiscale"/><br>
    </label> <!-- codice fiscale -->
    <label>
        Email:
        <!--<input type="text" pattern="[a-zA-z]+@[a-zA-z]+\.[a-z]{2,}" name="email"/><br>-->
        <input type="text" name="email"/><br>
    </label> <!-- Email -->
    <label>
        Via:
        <!--<input type="text" pattern="[A-Z a-z 0-9]{,25}" name="via"/><br>-->
        <input type="text" name="via"/><br>
    </label> <!-- via -->
    <label>
        Citta:
        <!--<input type="text" pattern="[A-Z a-z]{}[\s][(][A-Z]{}[)]" name="citta"/><br>-->
        <input type="text" name="citta"/><br>
    </label> <!-- citta -->
    <label>
        CAP:
        <!--<input type="text" pattern="[0-9]{5}" name="cap"/><br>-->
        <input type="text" name="cap"/><br>
    </label> <!-- cap -->
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
    $codice = $_POST["codice_fiscale"];
    $citta = $_POST["citta"];
    $via = $_POST["via"];
    $cap = $_POST["cap"];
    $email = $_POST["email"];

    $output = "Errore: ";

    if ( $cognome != "" ) {
        if ($nome != "") {
            if (strlen($codice) == 16) {
                if (strpos($email, '@') >= 0 && strpos($email, '.') >= 0) {
                    if (strlen($citta) > 3) {

                        $prova = explode(" ", $citta);
                        if ( $prova[1][0] == '(' && $prova[1][strlen($prova[1])-1] == ')') {
                            if (intval($cap) > 10000 && intval($cap) < 99999) {
                                $output = "Cognome: " . $cognome . " Nome: " . $nome . "<br>" .
                                    "Codice: " . $codice . " via: " . $via . "<br>" .
                                    "patente: " . $cap . " email:" . $email;
                            } else $output .= "il cap non ha 5 cifre (numero)";
                        } else $output .= "non è stata trovata la provincia";
                    } else $output .= "Non esistono città con 3 caratteri";
                } else $output .= "l'email deve contenere sia @ e sia .";
            } else $output .= "il codice fiscale deve essere almeno di 16";
        } else $output .= "il nome non può essere vuoto";
    } else $output .= "il cognome non può essere vuoto";
}
?>
<?php echo $output; ?>
</body>
</html>