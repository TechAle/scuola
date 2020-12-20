<?php
session_start();
$nomeSito = "";
include "globali.php";
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

    <!-- body -->
    <br><br><br><br>
    <fieldset>
        <div class="row">
            <div class="featuresanimate">
                <div id="features" class="section scrollspy">
                    <div class="container">
                        <h2 style="text-decoration:underline;text-align:center;font-weight:bold;font-family:Comic Sans MS">I nostri dipendenti</h2>
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
                                $num = 0;
                                // Itero per ogni valore
                                foreach ($effettuati as $persona) {
                                    if ($num == 0) {
                                        echo '<div class="features">';
                                    }
                                    echo '<div class="col s4">';
                                    // Leggo il file
                                    $f = fopen("./soci/".$persona . ".txt", 'r');
                                    $info = fread($f, filesize("./soci/".$persona . ".txt"));
                                    $info_pers = explode(";", $info);
                                    fclose($f);
                                    // Stampo
                                    echo '<img src="./soci/'. $persona .'.jpg" height="100" width="100">';
                                    echo '<h3>'. $info_pers[0] .'</h3>';
                                    echo '<ul>';
                                    echo sprintf('<li>%s</li>', $info_pers[1]);
                                    echo '</ul>';

                                    echo '</div>';
                                    $num++;
                                    if ($num == 3) {
                                        $num = 0;
                                        echo '</div>';
                                    }
                                }

                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>

    </fieldset>


    <!-- nav -->
    <div id="footer" style="background-color: #ee6e73; padding-left: 10px">
        <h5 class="white-text"><?php echo $nomeSito?>, copyright 1001-2101</h5>
        <div style="position: absolute; right: 30px; bottom: 15px">
            <a href="contattami.php" class="btn button-collapse red hoverable">contattami</a>
        </div>
    </div>

    </body>
</html>