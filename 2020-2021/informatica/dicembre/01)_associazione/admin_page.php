<?php
require "./phpmailer/PHPMailer.php";
require "./phpmailer/SMTP.php";
require "./phpmailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require('./fpdf182/fpdf.php');
// Carico il nostro file
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$output_ricerca = "";
$INI = parse_ini_file('./config.ini', true);
$riservata = $INI['riservata'];

$nomeSito = "";
include "globali.php";

// Se vuole fare il logout
if (isset($_GET["logout"]) && $_GET["logout"] == 1) {
    $_SESSION["isLogged"] = 0;
    echo "<script>location.href = 'info.php'</script>";
}

// Se non è già loggato

if (!(isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == 1)) {
    if (!($_POST["username"] == $riservata["username"]
        & $_POST["password"] == $riservata["password"]
        & $_POST["email"] == $riservata["email"])) {
        echo "<script>location.href = 'admin_login.php' </script>";
    }else {
        // Settiamo i vari dati
        $_SESSION["isLogged"] = 1;
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];
        $_SESSION["email"] = $_POST["email"];
    }
}
$email = $_SESSION["email"];
$username = $_SESSION["username"];

?>
<html lang="it">

<head>
    <title><?php echo $nomeSito ?> - Admin</title>

    <style>
        #footer {
            position:absolute;
            bottom:0;
            width:100%;
            height:60px;   /* Height of the footer */
        }
        #nuove_richieste {
            display: none;
        }
        #ricerca_socio_div {
            display: none;
        }
        #crea_pdf {
            display: none;
        }
        #email_id {
            display: none;
        }
        fieldset {
            max-height: 80%;
            overflow-y: scroll;
            overflow-x: hidden;
            margin-right: 8px;
            margin-left: 8px;

        }
    </style>

    <script>
        function menu() {
            document.getElementById("menu_principale").style.display = "block";
            document.getElementById("nuove_richieste").style.display = "none";
            document.getElementById("ricerca_socio_div").style.display = "none";
        }
        function richieste_nuove() {
            document.getElementById("menu_principale").style.display = "none";
            document.getElementById("nuove_richieste").style.display = "block";
        }
        function ricerca_socio() {
            document.getElementById("menu_principale").style.display = "none";
            document.getElementById("ricerca_socio_div").style.display = "block";
        }
        function crea_pdf() {
            document.getElementById("menu_principale").style.display = "none";
            document.getElementById("crea_pdf").style.display = "block";
        }
        function invia_email() {
            document.getElementById("menu_principale").style.display = "none";
            document.getElementById("email_id").style.display = "block";
        }
    </script>

</head>
<body>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>

<div class="row" style="background-color: lightblue">
    <div class="container" style="padding: 10px 10px 10px 10px; width: 100%">

        <ul id="slide-out" class="side-nav">
            <li><div class="user-view">
                    <a href="#"><img class="circle" src="https://pbs.twimg.com/profile_images/877063380720173057/cTzoJiZ2_400x400.jpg" style="z-index: -1" alt="img"></a>
                    <a href="#"><span class="black-text name">Admin Pagina</span></a>
                    <a href="#"><span class="black-text email"><?php echo $email ?></span></a>
                    <a href="#"><span class="black-text email"><?php echo $username ?></span></a>
                </div></li>

        </ul>
        <a href="#" data-activates="slide-out" class="btn button-collapse blue hoverable">Menu</a>
        <a href="admin_page.php?logout=1" style="float: right" class="btn blue hoverable">Logout</a>
    </div>
</div>
<script type="text/javascript">
    $(".button-collapse").sideNav();
</script>

<!-- Visualizziamo a seconda di ciò che vuole -->
<fieldset>

    <div id="menu_principale">
        <div style="position: absolute; right: 30px;">
            <button class="btn button-collapse blue hoverable" onclick="ricerca_socio()">Ricerca un socio</button><br>
        </div>
        <button style="position: absolute; right: 30px; margin-top: 50px;" class="btn button-collapse blue hoverable" onclick="invia_email()">Invia Email</button>
        <button class="btn button-collapse blue hoverable" onclick="richieste_nuove()">Guarda le nuove richieste</button><br>
        <button style="margin-top: 10px" class="btn button-collapse blue hoverable"  onclick="crea_pdf()">Crea Pdf</button><br>
    </div>

    <div id="email_id">

        <?php
        $a = 0;
        $effettuati = array();
        foreach(scandir("soci") as $file) {
            // Se non è dentro
            if (!in_array($file[0], $effettuati) && $file[0] != '.' && $file[0] != 's'&& $file[0] != 'c') {
                array_push($effettuati, $file[0]);
            }
        }
        // Controllo che non sia vuoto
        if (count($effettuati) != 0 ) {
            echo '<form action="" method="post">';
            // Itero per ogni valore
            foreach ($effettuati as $persona) {
                // Leggo il file
                $f = fopen("./soci/".$persona . ".txt", 'r');
                $info = fread($f, filesize("./soci/".$persona . ".txt"));
                $info_pers = explode(";", $info);
                fclose($f);
                // Stampo
                echo sprintf('<div><input type="checkbox" id="%s" name="%s"><label for="%s">Id: %s | Nome: %s | Cognome: %s | Email: %s | Data Nascita: %s</label></div>',
                    $persona, $persona,$persona, $persona,$info_pers[0], $info_pers[1],$info_pers[3], $info_pers[2]);
            }
            echo '<input type="text" name="comunicazione"><br><input type="submit" name="invia_email"/>   <button onclick="menu()">indietro</button></form>';
        }
        // Senò stampa nessuna nuova richiesta
        else {echo "Nessun Socio Trovato <button onclick='menu()'>ok</button>"; $a = 1;}

        if (isset($_POST["invia_email"]) && $a == 0) {
            // Itero per tutti quanti
            foreach(array_keys($_POST) as $parametro) {
                if ($parametro != "invia_email" && $parametro != "comunicazione") {
                    $r = fopen("./soci/$parametro" . ".txt", 'r');
                    $info = fread($r, filesize("./soci/".$persona . ".txt"));
                    $info_pers = explode(";", $info);
                    $email = $info_pers[3];
                    fclose($r);

                    $mail = new PHPMailer(true);

                    //Set PHPMailer to use SMTP.
                    $mail->isSMTP();
                    //Set SMTP host name
                    $mail->Host = "smtp.gmail.com";
                    //Set this to true if SMTP host requires authentication to send email
                    $mail->SMTPAuth = true;
                    //Provide username and password
                    $mail->Username = "alessandro.condello@studenti.fauser.edu";
                    $mail->Password = "Password Segreta";
                    //If SMTP requires TLS encryption then set it
                    $mail->SMTPSecure = "tls";
                    //Set TCP port to connect to
                    $mail->Port = 587;

                    $mail->From = $info_pers[3];
                    $mail->FromName = "Alessandro Condello";

                    $mail->addAddress($info_pers[3], "Operatore");

                    $mail->isHTML(true);

                    $mail->Subject = "Richiesta urgente";
                    $mail->Body = "<h1>Attenzione</h1><br>" . $_POST["comunicazione"];
                    $mail->AltBody = $_POST["comunicazione"];

                    try {
                        $mail->send();
                        echo "I messaggi sono stati inviati";
                    } catch (Exception $e) {
                        echo "Mailer Error: " . $mail->ErrorInfo;
                    }
                }
            }
        }
        ?>

    </div>

    <div id="ricerca_socio_div">
        <form class="col s12" method="post" action="">
            <div class="row">
                <div class="input-field col s6">
                    <input placeholder="Inserire o il cognome o il codice" name="codice" id="codice" type="text" class="validate">
                    <label for="codice">codice</label>
                </div>
            </div>
            <button onclick='menu()'>indietro</button>
            <input type="submit" name="ricerca_btn">

        </form>
        <?php

        if (isset($_POST['ricerca_btn'])) {
            $codice = $_POST["codice"];
            $successo = 0;
            $idx = 0;
            if(is_numeric($codice)) {
                // Allora è un codice
                $tipo = 0;
            }else $tipo = 1;

            $f = fopen("./soci/soci.txt", 'r');
            while(($linea = fgets($f)) !== false) {
                $lin = explode(" ", $linea);
                if (trim($lin[$tipo]) == $codice) {
                    $idx = $lin[0];
                    $successo = 1;
                    break;
                }
            }

            // Se non è stato trovato
            if ($successo == 0)
                $output_ricerca = $codice . " non trovato";
            else {
                $f = fopen("./soci/".$idx . ".txt", 'r');
                $info = fread($f, filesize("./soci/".$idx . ".txt"));
                $info_pers = explode(";", $info);
                fclose($f);
                // Stampo
                $output_ricerca =  sprintf('Risultato: Id: %s | Nome: %s | Cognome: %s | Email: %s | Data Nascita: %s</label></div>',
                    $idx, $info_pers[0], $info_pers[1],$info_pers[3], $info_pers[2]);

            }
        }

        echo $output_ricerca;
        ?>

    </div>

    <div id="nuove_richieste">

        <?php
            $effettuati = array();
            foreach(scandir("richieste") as $file) {
                // Se non è dentro
                if (!in_array($file[0], $effettuati) && $file[0] != '.' && $file[0] != 'n') {
                    array_push($effettuati, $file[0]);
                }
            }
            // Controllo che non sia vuoto
            if (count($effettuati) != 0 ) {
                echo '<form action="" method="post">';
                // Itero per ogni valore
                foreach ($effettuati as $persona) {
                    // Leggo il file
                    $f = fopen("./richieste/".$persona . ".txt", 'r');
                    $info = fread($f, filesize("./richieste/".$persona . ".txt"));
                    $info_pers = explode(";", $info);
                    fclose($f);
                    // Stampo
                    echo sprintf('<div><input type="checkbox" id="%s" name="%s"><label for="%s">Id: %s | Nome: %s | Cognome: %s | Email: %s | Data Nascita: %s</label></div>',
                        $persona, $persona,$persona, $persona,$info_pers[0], $info_pers[1],$info_pers[3], $info_pers[2]);
                }
                echo '<input type="submit" name="invia"/></form>';
            }
            // Senò stampa nessuna nuova richiesta
            else echo "nessuna nuova richiesta <button onclick='menu()'>ok</button>";

            if (isset($_POST["invia"])) {
                // Itero per tutti quanti
                foreach(array_keys($_POST) as $parametro) {
                    if ($parametro != "invia") {
                        // Muoviamo tutti i file
                        rename("./richieste/" . $parametro . ".txt", "./soci/" . $parametro . ".txt");
                        rename("./richieste/" . $parametro . ".jpg", "./soci/" . $parametro . ".jpg");
                        rename("./richieste/" . $parametro . ".pdf", "./soci/" . $parametro . ".pdf");
                        // Aggiungo "soci.txt"
                        $f = fopen("./soci/soci.txt", 'a');
                        $r = fopen("./richieste/$parametro" . ".txt", 'r');
                        $info = fread($r, filesize("./richieste/".$persona . ".txt"));
                        $info_pers = explode(";", $info);
                        fwrite($f, $parametro . ' ' . $info_pers[1]);
                        fclose($f);
                        fclose($r);
                    }
                }
                // Eliminiamo tutti i file rimanenti
                foreach(scandir("./richieste/") as $file) {
                    if ($file[0] != '.' && $file[0] != 'n')
                        unlink("./richieste/" . $file);
                }
                echo "<script>location.href = admin_page.php</script>";
            }
        ?>

    </div>

    <div id="crea_pdf">
        <form class="col s12" method="post" action="">
            <div class="row">
                <div class="input-field col s6">
                    <input placeholder="Inserire o il cognome o il codice" name="codice" id="codice" type="text" class="validate">
                    <label for="codice">codice</label>
                </div>
            </div>
            <button onclick='menu()'>indietro</button>
            <input type="submit" name="crea_pdf">

        </form>
        <?php
        $risultato = "";
        if (isset($_POST['crea_pdf'])) {
            $codice = $_POST["codice"];
            $successo = 0;
            $idx = 0;
            if(is_numeric($codice)) {
                // Allora è un codice
                $tipo = 0;
            }else $tipo = 1;

            $f = fopen("./soci/soci.txt", 'r');
            while(($linea = fgets($f)) !== false) {
                $lin = explode(" ", $linea);
                if (trim($lin[$tipo]) == $codice) {
                    $idx = $lin[0];
                    $successo = 1;
                    break;
                }
            }

            // Se non è stato trovato
            if ($successo == 0)
                $output_ricerca = $codice . " non trovato";
            else {
                $f = fopen("./soci/".$idx . ".txt", 'r');
                $info = fread($f, filesize("./soci/".$idx . ".txt"));
                $info_pers = explode(";", $info);
                fclose($f);
                // Stampo
                $risultato =  " ";
                $output_ricerca = sprintf("l'utente a lei imesso è stato trovato, Il file lo può trovare nella cartella 'tessere'<br><a href='./tessere/". $idx . ".pdf'>clicca qui per aprire il file</a>");
            }
        }

        echo $output_ricerca;
        if ($risultato != "") {
            $pdf = new FPDF('P','mm',"A3");
            $pdf->SetFont('Arial', '', 45);
            $pdf->AddPage();
            $pdf->Cell(275,30,$nomeSito . " - Tessera",1,1,'C');
            $pdf->Image("./soci/" . $idx . ".jpg", 10, 50, 100, 100);
            $pdf->SetFont('Arial', '', 20);
            $pdf->Text(125, 70, "Nome: " . $info_pers[0]);
            $pdf->Text(125, 80, "Cognome: " . $info_pers[1]);
            $pdf->Text(125, 90, "Email: " . $info_pers[3]);
            $pdf->Output("F", "./tessere/" . $idx . ".pdf");
        }
        ?>
    </div>

    <?php
    if (isset($_POST["ricerca_btn"])) {
        echo "<script>ricerca_socio()</script>";
    }
    if (isset($_POST["crea_pdf"])) {
        echo "<script>crea_pdf()</script>";
    }
    if (isset($_POST["invia_email"])) {
        echo "<script>invia_email()</script>";
    }
    ?>

</fieldset>


<div id="footer" style="background-color: lightblue; padding-left: 10px">
    <h5 class="white-text"><?php echo $nomeSito?>, copyright 1001-2101</h5>
</div>

</body>

</html>
