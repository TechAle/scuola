<?php
session_start();

require_once "classes/Member.php";
require_once "classes/Util.php";
require_once "classes/authCookieSessionValidate.php";

$util = new Util();
$ds = new DBController();
$member = new Member();
$messaggio = "";

if(!$isLoggedIn) {
    header("Location: ./");
} else {
    if (isset($_SESSION["member_id"]))
        $current_id = $_SESSION["member_id"];
    else
        $current_id = $member->getId($_COOKIE['member_login']);

    // echo "<p>Elimina: ".$_POST["elimina"]."</p>";
    // echo "<p>Vota: ".$_POST["submit_voto"]."</p>";
    // echo "<p>Modifica: ".$_POST["modifica"]."</p>";
    // echo "<p>Segnala: ".$_POST["segnala"]."</p>";
    // echo "<p>Commenta: ".$_POST["commenta"]."</p>";
    // echo "<p>Foto: ".$_POST["photo_id"]."</p>";

    if (isset($_POST["elimina"])) {
        $arr = array(
            $_POST["photo_id"]
        );
        $risposta = $member->cancellaImmagine($arr);
        $messaggio = $risposta["message"];

    }

    if (isset($_POST["submit_voto"])) {
        $query = "SELECT vote FROM vote WHERE member_id = ? AND photo_id = ?";
        $paramType = "ii";
        $paramValue = array(
            $current_id,
            $_POST["photo_id"]
        );
        $votoPresente = $ds->select($query, $paramType, $paramValue);

        $query = "UPDATE photo SET ";
        if (empty($votoPresente[0]["vote"])) {
            $inserisciVoto = "INSERT INTO vote (member_id, photo_id, vote) VALUES (?, ?, ?)";
            $paramType = "iii";
            $paramValue = array(
                $current_id,
                $_POST["photo_id"],
                $_POST["submit_voto"]
            );
            $ds->insert($inserisciVoto, $paramType, $paramValue);
        } else if ($votoPresente[0]["vote"] > 0 && $votoPresente[0]["vote"] != $_POST["submit_voto"]) {
            switch ($votoPresente[0]["vote"]) {
                case 1:
                    $query .= "1_stella = 1_stella - 1, ";
                    break;
                case 2:
                    $query .= "2_stelle = 2_stelle - 1, ";
                    break;
                case 3:
                    $query .= "3_stelle = 3_stelle - 1, ";
                    break;
                case 4:
                    $query .= "4_stelle = 4_stelle - 1, ";
                    break;
                case 5:
                    $query .= "5_stelle = 5_stelle - 1, ";
                    break;
            }

            $aggiornaVoto = "UPDATE vote SET vote = ? WHERE member_id = ? AND photo_id = ?";
            $paramType = "iii";
            $paramValue = array(
                $_POST["submit_voto"],
                $current_id,
                $_POST["photo_id"]
            );
            $ds->update($aggiornaVoto, $paramType, $paramValue);
        }

        if (empty($votoPresente[0]["vote"]))
            $votoPresente[0]["vote"] = 0;

        if ($votoPresente[0]["vote"] != $_POST["submit_voto"]) {
            switch ($_POST["submit_voto"]) {
                case 1:
                    $query .= "1_stella = 1_stella + 1 ";
                    break;
                case 2:
                    $query .= "2_stelle = 2_stelle + 1 ";
                    break;
                case 3:
                    $query .= "3_stelle = 3_stelle + 1 ";
                    break;
                case 4:
                    $query .= "4_stelle = 4_stelle + 1 ";
                    break;
                case 5:
                    $query .= "5_stelle = 5_stelle + 1 ";
                    break;
            }
            $query .= "WHERE photo_id = ?";
            $paramType = 'i';
            $paramValue = array(
                $_POST["photo_id"]
            );
            $ds->update($query, $paramType, $paramValue);

            $messaggio = "Voto inserito/aggiornato";
        } else {
            $messaggio = "Voto già presente";
        }
    }

    if (isset($_POST["modifica"])) {
        $query = "UPDATE photo SET description = ? WHERE photo_id = ?";
        $paramType = 'si';
        $paramValue = array(
            $_POST["new_description"],
            $_POST["photo_id"]
        );
        $ds->update($query, $paramType, $paramValue);
        $messaggio = "Descrizione aggiornata";
    }

    if (isset($_POST["segnala"])) {
        $query = "UPDATE photo SET segnalazione = 1 WHERE photo_id = ?";
        $paramType = 'i';
        $paramValue = array(
            $_POST["photo_id"]
        );
        $ds->update($query, $paramType, $paramValue);
        $messaggio = "Segnalazione effettuata";
    }

    if (isset($_POST["commenta"])) {
        $query = "INSERT INTO comment (comment, member_id, photo_id) VALUES (?, ?, ?)";
        $paramType = "sii";
        $paramValue = array(
            $_POST["comment"],
            $current_id,
            $_POST["photo_id"]
        );
        $ds->insert($query, $paramType, $paramValue);
        $messaggio = "Commento inserito";
    }

    if (isset($_POST["messaggio"])) {
        $time = "now()";
        $query = "INSERT INTO message (context, sender_id, receiver_id) VALUES (?, ?, ?)";
        $paramType = "sii";
        $paramValue = array(
            $_POST["message"],
            $current_id,
            $_POST["receiver_id"]
        );
        $ds->insert($query, $paramType, $paramValue);
        $messaggio = "Messaggio Inviato";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- MetaData -->


    <!-- Better mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GameSense</title>
    <!-- BootStrap -->
    <link rel="stylesheet" href="./dependences/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="./dependences/jquery.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- BootStrap things again -->
    <script src="./dependences/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="./dependences/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Page Css -->
    <style>


        /* Html Body normal css */
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            scroll-behavior: smooth;
            height: 100vh;
            background-color: white;
        }

        /* Nav Things */
        #top {
            margin-left: 0 !important;
            margin-right: 0 !important;
            width: 100%;
            max-width: 100%;
            height: 20%;
            margin-top: 0 !important;;
        }

        @keyframes rainbow {
            0% {
                filter: invert(50%) sepia(100%) saturate(1000%) hue-rotate(100deg) brightness(102%) contrast(102%);
                transform: rotate(0deg);
            }
            100% {
                filter: invert(50%) sepia(50%) saturate(1000%) hue-rotate(200deg) brightness(102%) contrast(102%);
                transform: rotate(360deg);
            }
        }

        /* Logo sizes */
        #logoSmall {
            height: 50px;
            width: 80px;
            animation: rainbow 2s infinite;
            animation-direction: alternate-reverse;
        }

        /* Inside nav */
        #nav {
            background-color: blue !important;
            border-bottom: solid #ececec 0px;
            width: 100%;
            z-index: 2;
        }

        /* Add line when we press the button in small screen */
        @media (max-width: 988px) {
            #navbarResponsive {
                border-top: 1px #acacac solid;
                margin-top: 8px;
            }
        }

        /* Main Content, we use display: Flex and flex-flow: column for making the actual content
           full size
         */
        #content {
            height: 100%;
            display: flex;
            flex-flow: column;

        }


        /* Padding for the nav */
        #padding-header {
            min-height: 100px;
        }

        .nav-link {
            color: white !important;
        }

        .custom-toggler.navbar-toggler {
            border-color: transparent;
        }
        /* Setting the stroke to green using rgb values (0, 128, 0) */

        .custom-toggler .navbar-toggler-icon {
            background-image: url(
            "data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 1)' stroke-width='3' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
        }

    </style>
</head>
<body>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark position-absolute " id="nav">

    <div class="container" id="top">
        <a class="navbar-brand" id="logo" href="#">
            <img src="./img/logo.svg" alt="Belle Foto srl logo" id="logoSmall"> Belle Foto srl       </a>

        <button class="navbar-toggler ml-auto custom-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarResponsive"
                aria-controls="navbarResponsive"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="newDashboard.php">DasBoard
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="newMessaggi.php">Messaggi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="crediti_login.php">Crediti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="FAQ_login.php">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="terms_login.php">Terms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacts_login.php">Contacts</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="newAdmin.php">Admin
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="logout.php">Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<style>
    #body {
        height: 100%;
        overflow-y: scroll;
        overflow-x: hidden;
    }
    .btn-outline-primary:hover {
        color: blue;
    }
    .btn-outline-primary {
        color: blue;
    }
    #form-ricerca {
        margin-bottom: 10px;
    }

    .table-dark {
        overflow-x: hidden;
        max-width: 100%;
        margin-bottom: 80px;
    }


</style>
<div id="content">
    <!-- Since we have an header that is absolute, we have to simulate his height, and we'll do this is a padding  -->
    <div id="padding-header">
    </div>
    <div id="body" class="container">
        <div class="col-12" style="background-color: lightgray;">
            <div id="ricerca">
                <form id="form_ricerca" method="post" class="row justify-content-center">

                    <div class=" col-sm-3 my-1">
                        <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">R</div>
                            </div>
                            <input type="textbox" name="ricerca" class="form-control" id="inlineFormInputGroupUsername" placeholder="Ricerca">
                            <input type="hidden" name="filtra" value="1"/>
                        </div>
                    </div>
                    <div class="col-auto my-1">
                        <button type="submit" class="btn btn-outline-primary" style="background-color: white"  name="submit_ricerca" value="Cerca">Ricerca</button>
                        <button type="submit" class="btn btn-outline-primary" style="background-color: white"  value="Reset">Reset</button>
                    </div>
                </form>
            </div>

            <?php

            $query = "SELECT * FROM photo";
            if (isset($_POST["filtra"])) {
                $query = "SELECT * FROM photo WHERE description LIKE '%" . $_POST["ricerca"] . "%'";
            }
            $resultArray = $ds->select($query);
            $in = false;
            if (!empty($resultArray)) {
                echo "<div style='width: 100%'>";
                echo "<table border='1' style ='display: flex;justify-content: center;align-items: center;'>";
                $cont = 0;
                foreach (array_reverse($resultArray) as $arr) {
                    // if img != nascosta, mostra
                    if ($arr['hidden'] == false) {
                        $in = true;
                        // Prima parte
                        echo '<div class="row">
                            <table class="table table-bordered table-dark">
                                <tbody>
                                <tr>
                                    <td colspan="3" style="text-align: center">';
                        // Descrizione
                        if (!empty(trim($arr["description"]))) {
                            echo $arr["description"];
                        } else {
                            echo "Nessuna Descrizione";
                        }
                        // Seconda parte
                        echo '</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <center>';
                        // Immagine
                        echo "<img src='imgs/".$arr["file_name"]."' style='width: 250px' />";
                        // Seconda parte
                        echo "</center>
                                </td>
                                </tr>
                                <tr>
                                    <td>";
                        // Chi
                        $query2 = "SELECT count(*) FROM comment WHERE photo_id =".$arr["photo_id"];
                        $count = $ds->select($query2);
                        echo '<tr>
                                <td>'.$member->getEmailByID($arr["member_id"]).'</td>
                                <td>'.$arr["data_scatto"].'</td>
                                <td>Commenti: '.$count[0]["count(*)"].'</td>
                            </tr>';
                        // Mostra media voto
                        if (!empty(trim($arr["media"]))) {
                            echo "<tr><td>Numero valutazioni: ".($arr["1_stella"] + $arr["2_stelle"]+ $arr["3_stelle"]+ $arr["4_stelle"]+ $arr["5_stelle"])."</td>";
                            echo "<td colspan='2'>Votazione media: ".$arr["media"]."</td></tr>";
                        } else {
                            echo "<tr><td>Ancora nessun voto registrato</td></tr>";
                        }
                        // Votazione foto solo se utente diverso
                        if ($current_id != $arr["member_id"]) {
                            echo "<tr><td>Lascia un voto</td>";
                            echo "<td colspan='2'><form id='form_vota' method='post'><input type='hidden' name='photo_id' value='".$arr["photo_id"]."'/><input type='submit' name='submit_voto' value='1'/><input type='submit' name='submit_voto' value='2'/><input type='submit' name='submit_voto' value='3'/><input type='submit' name='submit_voto' value='4'/><input type='submit' name='submit_voto' value='5'/></form></tr>";
                            // Segnala foto
                            echo "<tr><td><form id='form_segnala_foto' method='post'><input type='hidden' name='photo_id' value='".$arr["photo_id"]."'/><input type='hidden' name='segnala' value='1'/><input type='submit' name='submit_segnala' value='Segnala foto'/></form></td>";
                            echo "<td colspan='2'>Invia un messaggio all'autore della foto: <form id='form_messaggio' method='post'><input type='textbox' name='message'/><input type='hidden' name='receiver_id' value='".$arr["member_id"]."'/><input type='hidden' name='messaggio' value='1'/><input type='submit' name='submit_messaggio' value='Invia'/></form></td></tr>";
                        }

                        if ($current_id == $arr["member_id"]) {
                            echo "<tr><td colspan='2'><form id='form_modifica_descrizione' method='post'><input type='hidden' name='photo_id' value='".$arr["photo_id"]."'/><input type='hidden' name='modifica' value='1'/><input type='textbox' name='new_description'/><input type='submit' name='submit_modifica' value='Modifica descrizione'/></form></td>";
                            echo "<td><form id='form_elimina_foto' method='post'><input type='hidden' name='photo_id' value='".$arr["photo_id"]."'/><input type='hidden' name='elimina' value='1'/><input type='submit' name='submit_elimina' value='Elimina foto'/></form></td></tr>";
                        }

                        // Mappa se presente
                        if ($arr['lat'] != NULL && $arr['lng'] != NULL)
                        {
                            $imgLat = $arr['lat'];
                            $imgLng = $arr['lng'];

                            echo '<tr><td>Mappa: </td><td colspan="2"><div id="map'.$cont.'" style="display: flex;justify-content: center;align-items: center;position: center;height: 300px; width: 100%" class="sign-up-container"></div></td></tr>'
                            ?>
                            <script>
                                var map = L.map('<?php echo "map".$cont; ?>').setView([<?php echo $imgLat; ?>, <?php echo $imgLng; ?>], 4);

                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright%22%3EOpenStreetMap</a> contributors'
                                }).addTo(map);

                                L.marker([<?php echo $imgLat; ?>, <?php echo $imgLng; ?>]).addTo(map)
                                    .bindPopup("Img: <?php echo $arr['file_name']. '<br> Lat: '.$imgLat. '<br> Long: '.$imgLng?>")
                                    .openPopup();
                            </script>
                            <?php
                        }
                        // Lascia commento
                        echo "<td colspan='3'>Lascia un commento: <form id='form_commenta' method='post'><input type='textbox' name='comment'/><input type='hidden' name='photo_id' value='".$arr["photo_id"]."'/><input type='hidden' name='commenta' value='1'/><input type='submit' name='submit_commenta' value='Commenta'/></form></td>";
                    echo '
                    <tr>
                        <td colspan="3">Commenti:</td>
                    </tr>';
                        // Lista commenti
                        $query = "SELECT comment, member_id FROM comment WHERE photo_id =".$arr["photo_id"];
                        $commenti = $ds->select($query);
                        if (!empty($commenti)) {
                            foreach ($commenti as $comm) {
                                $id = $comm["member_id"];
                                $utente = $member->getEmailByID($id);
                                $datiUtente = $member->getMember($utente);
                                echo "<tr><td>".$utente."</td><td><img src='pfp/".$datiUtente[0]["member_profile_picture"]."' style='max-width: 32px' /></td><td>".$comm["comment"]."</td></tr>";
                            }
                        }
                    echo '
                    </tbody>
                        </table>
                    </div>';

                    }
                }
            }
            ?>
            <!--
            <div class="row">
                <table class="table table-bordered table-dark">
                    <tbody>
                    <tr>
                        <td colspan="3" style="text-align: center">Descrizione</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <center>
                                <img src="./img/background.png" style="height: 250px ">
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td>Chi</td>
                        <td>Dati</td>
                        <td>N^Commenti</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <center>
                                Ancora nessun voto registrato
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Votazione media: 5
                        </td>
                        <td>
                            Numero votazioni: 1
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">Lascia un voto</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="row">
                                <div class="col-1"><button>1</button></div>
                                <div class="col-1"><button>2</button></div>
                                <div class="col-1"><button>3</button></div>
                                <div class="col-1"><button>4</button></div>
                                <div class="col-1"><button>5</button></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><form><input type="text"> Invia messaggio autore</form></td>
                        <td>Segnala</td>
                    </tr>
                    <tr>
                        <td colspan="2"> <form><input type="text"> Modifica Descrizione</form></td>
                        <td>Elimina</td>
                    </tr>
                    <tr>
                        <td>Mappa: </td>
                        <td colspan="2">
                            <div id="map0" style="display: flex; justify-content: center; align-items: center; height: 100px !important; width: 300px; position: relative;" class="sign-up-container leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0"><div class="leaflet-pane leaflet-map-pane" style="transform: translate3d(0px, 0px, 0px);"><div class="leaflet-pane leaflet-tile-pane"><div class="leaflet-layer " style="z-index: 1; opacity: 1;"><div class="leaflet-tile-container leaflet-zoom-animated" style="z-index: 18; transform: translate3d(0px, 0px, 0px) scale(1);"><img alt="" role="presentation" src="https://b.tile.openstreetmap.org/4/9/7.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(-163px, -49px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://c.tile.openstreetmap.org/4/10/7.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(93px, -49px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://c.tile.openstreetmap.org/4/9/8.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(-163px, 207px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://a.tile.openstreetmap.org/4/10/8.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(93px, 207px, 0px); opacity: 1;"></div></div></div><div class="leaflet-pane leaflet-shadow-pane"><img src="https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png" class="leaflet-marker-shadow leaflet-zoom-animated" alt="" style="margin-left: -12px; margin-top: -41px; width: 41px; height: 41px; transform: translate3d(150px, 150px, 0px);"></div><div class="leaflet-pane leaflet-overlay-pane"></div><div class="leaflet-pane leaflet-marker-pane"><img src="https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -12px; margin-top: -41px; width: 25px; height: 41px; transform: translate3d(150px, 150px, 0px); z-index: 150;"></div><div class="leaflet-pane leaflet-tooltip-pane"></div><div class="leaflet-pane leaflet-popup-pane"><div class="leaflet-popup  leaflet-zoom-animated" style="opacity: 1; transform: translate3d(151px, 116px, 0px); bottom: -7px; left: -59px;"><div class="leaflet-popup-content-wrapper"><div class="leaflet-popup-content" style="width: 77px;">Img: aaa.PNG<br> Lat: 5<br> Long: 50</div></div><div class="leaflet-popup-tip-container"><div class="leaflet-popup-tip"></div></div><a class="leaflet-popup-close-button" href="#close">×</a></div></div><div class="leaflet-proxy leaflet-zoom-animated" style="transform: translate3d(2616.89px, 1991.04px, 0px) scale(8);"></div></div><div class="leaflet-control-container"><div class="leaflet-top leaflet-left"><div class="leaflet-control-zoom leaflet-bar leaflet-control"><a class="leaflet-control-zoom-in" href="#" title="Zoom in" role="button" aria-label="Zoom in">+</a><a class="leaflet-control-zoom-out" href="#" title="Zoom out" role="button" aria-label="Zoom out">−</a></div></div><div class="leaflet-top leaflet-right"></div><div class="leaflet-bottom leaflet-left"></div><div class="leaflet-bottom leaflet-right"><div class="leaflet-control-attribution leaflet-control"><a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> | © </div></div></div></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"> <form><input type="text"> Lascia un commento</form></td>
                    </tr>
                    <tr>
                        <td colspan="3">Commenti:</td>
                    </tr>
                    <tr>
                        <td width="10%"><center><img style="height: 40px" src="img/background.png"></center></td>
                        <td width="30%">Email</td>
                        <td width="60%">Messaggio</td>
                    </tr>
                    </tbody>
                </table>
            </div>-->

        </div>
    </div>
</div>


<!--Modal: modalCookie-->
<div class="modal fade top" id="modalCookie1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog modal-frame modal-top modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Body-->
            <div class="modal-body">
                <div class="row d-flex justify-content-center align-items-center">

                    <p class="pt-3 pr-2"><?php echo $messaggio ?></p>

                    <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Chiudi</a>
                </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>

<script>
    <?php
        if ($messaggio != "") {
            echo "$('#modalCookie1').modal('show');";
        }
        ?>
</script>

</body>
</html>
