<?php
$nomeSito = "";
include "globali.php";
?>
<html lang="it">
    <head>
        <title><?php echo $nomeSito ?> - richiesta</title>
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
        .select-dropdown>li>span {
            color: #e70000 !important;
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
                <li><a href="#">Richiesta</a></li>
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
        $(document).ready(function(){
            $('select').formSelect();
        });
        $(".dropdown-content>li>span").css("color", "black");
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
                    <input placeholder="data" name="data" id="data" type="date" class="validate">
                    <label for="data">Data nascita e email</label>
                </div>
                <div class="input-field col s6">
                    <input id="email" name="email" type="text" class="validate">
                    <label for="email">email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input name="professione" placeholder="professione" id="professione" type="text" class="validate">
                    <label for="professione">Genere e professione</label>
                </div>
                <div class="input-field col s6">
                    <select id="genere" name="genere" >
                        <option value="" disabled selected>Scegliere il tuo genere</option>
                        <option value="maschio">Maschio</option>
                        <option value="femmina">Femmina</option>
                        <option value="binario">Non Specifico</option>
                    </select>
                    <label for="genere">genere</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input name="indirizzo" placeholder="indirizzo" id="indirizzo" type="text" class="validate">
                    <label for="indirizzo">indirizzo</label>
                </div>
            </div>
            <div class="file-field input-field">
                <div class="btn" style="background-color: #F44336 !important">
                    <span>File</span>
                    <input accept=".jpg" type="file" id="fototessera" name="fototessera">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="carica la fototessera con estensione jpg">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <select name="documento" id="documento" >
                        <option value="" disabled selected>Scegliere il tuo documento</option>
                        <option value="carta">Carta di identita</option>
                        <option value="tessera">Tessera sanitaria</option>
                        <option value="patente">Patente</option>
                    </select>
                    <label for="documento">Documento</label>
                </div>
                <div class="file-field input-field">
                    <br>
                    <div class="btn" style="background-color: #F44336 !important">
                        <span>File</span>
                        <input type="file" id="document_f" name="documento_f">
                    </div>
                    <div class="file-path-wrapper" style="margin-right: 7px">
                        <input class="file-path validate" type="text" placeholder="carica il documento con estensione pdf">
                    </div>
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
        //echo '<script>alert("Richiesta eseguita con successa")</script>';
        // Leggiamo
        $f = fopen("./richieste/numero.txt", "r") or die("Unable to open file!");
        $numero = fread($f, filesize("./richieste/numero.txt"));
        $numero++;
        fclose($f);

        // Scrivo i vari dati
        $f = fopen("./richieste/" . $numero . ".txt", "w");
        fwrite($f, sprintf("%s;%s;%s;%s;%s;%s;%s;%s", $_POST["nome"], $_POST["cognome"], $_POST["data"], $_POST["email"], $_POST["professione"], $_POST["genere"], $_POST["indirizzo"], $_POST["documento"]));
        // Salvo il file
        fclose($f);
        // Fototessera
        move_uploaded_file($_FILES["fototessera"]["tmp_name"], "./richieste/" . $numero . ".jpg");
        // Documento
        move_uploaded_file($_FILES["documento_f"]["tmp_name"], "./richieste/" . $numero . ".pdf");
        // Scriviamo a che codice siamo arrivati;
        $f = fopen("./richieste/numero.txt", "w") or die("Unable to open file!");
        fwrite($f, $numero);
        fclose($f);
    }

    ?>

    <!-- nav -->
    <div id="footer" style="background-color: #ee6e73; padding-left: 10px">
        <h5 class="white-text"><?php echo $nomeSito?>, copyright 1001-2101</h5>
    </div>
    </body>
</html>