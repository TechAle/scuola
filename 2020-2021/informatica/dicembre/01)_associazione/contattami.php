<?php
session_start();
$nomeSito = "";
include "globali.php";
require "./phpmailer/PHPMailer.php";
require "./phpmailer/SMTP.php";
require "./phpmailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>
<html lang="it">
<head>
    <title><?php echo $nomeSito ?> - info</title>
</head>
<style>
    body, html {
        height: 100%;
    }
    #footer {
        position:absolute;
        bottom:0;
        width:100%;
        height:60px;   /* Height of the footer */
    }
    fieldset {
        height: 75%;
        overflow-y: scroll;
        overflow-x: hidden;
        margin-right: 8px;
        margin-left: 8px;

    }
</style>
<body>
<!-- materialize -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
<!-- sito -->
<!-- nav -->

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<nav class="red" style="padding:0px 10px; position: fixed;">
    <div class="nav-wrapper">
        <a href="#" class="brand-logo"><?php echo $nomeSito ?></a>

        <a href="#" class="sidenav-trigger" data-target="mobile-nav">
            <i class="material-icons">menu</i>
        </a>

        <ul class="right hide-on-med-and-down "  >
            <li><a href="#">Home</a></li>
            <li><a href="info.php">Info</a></li>
            <li><a href="#">Servizi</a></li>
            <li><a href="#">Sponsor</a></li>
            <li><a href="richiesta.php">Richiesta</a></li>
            <li><a href="admin_login.php">Admin</a> </li>
        </ul>
    </div>
</nav>


<ul class="sidenav" id="mobile-nav">
    <li><a href="#">Home</a></li>
    <li><a href="info.php">Info</a></li>
    <li><a href="#">Servizi</a></li>
    <li><a href="#">Sponsor</a></li>
    <li><a href="#">Richiesta</a> </li>
    <li><a href="admin_login.php">Admin</a> </li>
</ul>

<script>
    $(document).ready(function(){
        $('.sidenav').sidenav();
    });

</script>

<!-- body -->
<br><br><br><br>
<fieldset>

    <form class="col s12" method="post" action="" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s6">
                <input placeholder="nome" name="nome" id="nome" type="text" class="validate">
                <label for="nome">Nome e cognome</label>
            </div>
            <div class="input-field col s6">
                <input id="cognome" name="cognome" type="text" class="validate">
                <label for="cognome">cognome</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input id="numero" name="numero" type="tel" class="validate">
                <label for="numero">numero</label>
            </div>
            <div class="input-field col s6">
                <input id="email" name="email" type="text" class="validate">
                <label for="email">email</label>
            </div>
        </div>

        <div class="row">
            <button style="background-color: #F44336; margin-left: 8px" class="btn waves-effect waves-light" type="submit" name="invia">Invia
                <i class="material-icons right">send</i>
            </button>
            <button style="background-color: #F44336; float: right; margin-right: 8px" class="btn waves-effect waves-light" type="reset" name="reset">Reset
                <i class="material-icons right">clear</i>
            </button>
        </div>
    </form>

</fieldset>

<?php
if (isset($_POST["invia"])) {

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

    $mail->From = $_POST["email"];
    $mail->FromName = "Alessandro Condello";

    $mail->addAddress($_POST["email"], "Operatore");

    $mail->isHTML(true);

    $mail->Subject = "Richiesta urgente";
    $mail->Body = "<h1>Richiesta</h1><br>" . "la sua richiesta è stata presa in considerazione.";
    $mail->AltBody = "la sua richiesta è stata presa in considerazione.";

    try {
        $mail->send();
    } catch (Exception $e) {
        echo "C'è stato un errore durante l'invio dell'email. Contattare l'amministratore";
    }


}
?>

<!-- nav -->
<div id="footer" style="background-color: #ee6e73; padding-left: 10px">
    <h5 class="white-text"><?php echo $nomeSito?>, copyright 1001-2101</h5>
</div>

</body>
</html>