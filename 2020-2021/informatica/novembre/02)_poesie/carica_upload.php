<?php
session_start();

echo isset($_POST["logout"]);

// Controllare se una persona non è loggata
if (!isset($_SESSION['isLogged']) | $_SESSION['isLogged']==0) {}

// move_uploaded_file($file["tmp_name"], $path . $ext);
// Se è un logout
if (isset($_POST["logout"])) {
    echo "logout fatto con successo";
    $_SESSION["isLogged"] = 0;
}else {

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $INI = parse_ini_file('./config.ini', true);
    $riservata = $INI['riservata'];


    if (!isset($_SESSION['isLogged'])
        || $_SESSION['isLogged'] == 1 |
        isset($_POST["username"]) ||
        ($_POST["username"] == $riservata["username"] & $_POST["password"] == $riservata["password"])) {
        echo "login eseguito con successo<br>";
        $_SESSION['isLogged'] = 1;
        // Keys: name type tmp_name error size
        $file = $_FILES["file"];
        $estenzioni_consentite = array("txt");
        // Controllo estensione dell'immagine
        if (in_array($ext = strtolower(explode('.', $file["name"])[1]), $estenzioni_consentite)) {
            move_uploaded_file($file["tmp_name"], "./poesie/" . $file["name"]);
            $fi = fopen("./elenco_poesie.txt", 'a');
            fwrite($fi, substr($file["name"],0, -4) . ' ' . str_replace(" ", "-", $_POST["titolo"]));
            fclose($fi);
        } else echo "estensione non supportata";


    } else echo "Username o password errata";
}


