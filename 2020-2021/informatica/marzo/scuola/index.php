<?php
session_start();
$db_host = "";
$db_user = "";
$db_pass = "";
$db_name = "";
include "parametri.php";
$conn = new mysqli($db_host,$db_user,$db_pass, $db_name) or die("Errore connessione server");
if (isset($_GET["errore"])) {
    echo "<script>alert('Area non permessa')</script>";
}

if (isset($_GET["visualizza"])) {
    if (isset($_SESSION["grado"])) {
        $val = $_SESSION["grado"];
        if ($val != 3 && $val != 4) {
            header('Location: '.$_SERVER['PHP_SELF'] . "?errore");
        }
    }
}

if (isset($_GET["crea_circolari"])) {
    if (isset($_SESSION["grado"])) {
        $val = $_SESSION["grado"];
        if ($val != 2) {
            header('Location: '.$_SERVER['PHP_SELF'] . "?errore");
        }
    }
}

if (isset($_GET["crea_utente"])) {
    if (isset($_SESSION["grado"])) {
        $val = $_SESSION["grado"];
        if ($val != 1) {
            header('Location: '.$_SERVER['PHP_SELF'] . "?errore");
        }
    }
}


if (isset($_GET["logout"])) {
    if (isset($_SESSION["nome"]) != "") {
        $_SESSION["id"] = "";
        $_SESSION["nome"] = "";
        $_SESSION["grado"] = "";
        $_SESSION["email"] = "";
        echo "<script>alert('Logout eseguito con successo')</script>";
    } else echo "<script>alert('Non sei loggato')</script>";
}

//crea_utente
if (isset($_GET["logout"])) {
    if (isset($_SESSION["nome"]) != "") {
        $_SESSION["id"] = "";
        $_SESSION["nome"] = "";
        $_SESSION["grado"] = "";
        $_SESSION["email"] = "";
        echo "<script>alert('Logout eseguito con successo')</script>";
    } else echo "<script>alert('Non sei loggato')</script>";
}

if (isset($_POST["loginBut"])) {
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);
    $query = "SELECT * FROM utenti u where u.email like '".$email."'
						and u.password like '".$password."'";
    $ris = $conn->query($query) or die("Errore query" . $query);
    if ($ris->num_rows == 1)  {
        echo "<script>alert('Login eseguito con successo')</script>";
        $values = $ris->fetch_row();
        $_SESSION["id"] = $values[0];
        $_SESSION["nome"] = $values[1];
        $_SESSION["email"] = $values[4];
        $_SESSION["grado"] = $values[6];
        $query = 'select nome from LAVORO where grado = ' . $_SESSION["grado"];
        $ris = $conn->query($query) or die("Errore query" . $query);
        $val = $ris->fetch_row();
        $_SESSION["gradoTxt"] = $val[0];
    } else echo "<script>alert('Email o password non validi')</script>";
}
$nome = "";
$grado = "";
$email = "";
$gradoTxt = "";
if (isset($_SESSION["id"])) {
    $nome = $_SESSION["nome"];
    $grado = $_SESSION["grado"];
    $email = $_SESSION["email"];
    $gradoTxt = $_SESSION["gradoTxt"];
}

?>
<!DOCTYPE html>
<html lang="it">

    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link href='https://fonts.googleapis.com/css?family=Comfortaa:400,300,700|Open+Sans:100,400,300,600'
              rel='stylesheet' type='text/css'>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <script type="text/javascript" src="script.js"></script>
        <title>Fauser</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
            /* Questo viene abilitato solamente se è un amministratore */
            #notifiche {
                display: <?php
                $found = false;
                if ($nome != "") {
                    echo "initial";
                } else echo "none";
                ?>;
            }
            /* Questo viene abilitato quando abbiamo fatto il login */
            #utente {
                display: <?php
                if ($nome != "") {
                    echo "initial";
                } else echo "none";
                ?>;
            }
            #padding {
                padding: 15px 15px 15px 15px;
                background-color: white;
                height: 96%;
            }
            .content {
                background-color: lightgray;
            }
            /* Questo viene abilitato se siamo in circolare visione*/
            #leggi_circolari {
                display: <?php
                if (isset($_GET["leggi_circolari"])) {
                    echo "initial";
                    $found = true;
                } else echo "none";
                ?>;
            }
            /* Questo viene abilitato quando dobbiamo visualizzare una circolare*/
            #crea_circolari {
                display: <?php
                if (isset($_GET["crea_circolari"])) {
                    echo "initial";
                    $found = true;
                } else echo "none";
                ?>;
            }
            /* Questo viene abilitato quando dobbiamo creare un nuovo utente*/
            #crea_utente {
                display: <?php
                if (isset($_GET["crea_utente"])) {
                    echo "initial";
                    $found = true;
                } else echo "none";
                ?>;
            }
            /* Questo viene abilitato quando dobbiamo fare il login*/
            #login {
                display: <?php
                    if (isset($_GET["login"])) {
                    echo "initial";
                    $found = true;
                } else echo "none";
                ?>;
            }

            /* Questo viene abilitato quando dobbiamo confermare la registrazione*/
            #conferma {
                display: <?php
                if (isset($_GET["conferma"])) {
                    echo "initial";
                    $found = true;
                } else echo "none";
                ?>;
            }
            /* Questo viene abilitato solamente se siamo nella home */
            #home {
                display: <?php
                if ($found) echo "none";
                else echo "initial";
                ?>;
            }
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }

            #profilepic {
                <?php
                if ($email != "")
                    echo 'background-image: url("./usr/'.$email.'.png") !important;';
                ?>

            }
        </style>
    </head>
    <body>
    <div id="page">
        <div id="page-content">


            <div id="padding">

                <div id="home">
                    <center><h2>Benvenuto!</h2></center>
                    <br>
                    <div style="width: 100%; height: 40%; display: inline-flex">

                        <center style="width: 70%"> <h4>Ultima notizia:</h4> <br>
                            <img src="img/notizia.png" style="width: 100%">
                        </center>
                        <div style="width: 30%; margin: 5px 5px 5px 5px">
                            <div style="text-align: right;">
                                <br><br>Sono le <div id="time" style="font-size: 15px"> </div>
                            </div>
                            <script>
                                function updateClock() {
                                    var now = new Date(), // current date
                                        months = ['January', 'February', 'March', 'April']; // you get the idea
                                    time = now.getHours() + ':' + now.getMinutes(), // again, you get the idea

                                        // a cleaner way than string concatenation
                                        date = [now.getDate(),
                                            months[now.getMonth()],
                                            now.getFullYear()].join(' ');

                                    // set the content of the element with the ID time to the formatted string
                                    document.getElementById('time').innerHTML = [date, time].join(' / ');

                                    // call this function again in 1000ms
                                    setTimeout(updateClock, 1000);
                                }
                                updateClock(); // initial call

                            </script>
                        </div>

                    </div>

                </div>

                <div id="leggi_circolari">
                    <h3 style="text-align: center">Chi vuoi vedere?</h3>
                    <form method="get">
                        <input checked type="radio" id="circolareTutti"
                               name="circolare" value="self">
                        <label for="circolareTutti"><?php
                            if ($gradoTxt != "") {
                                echo $gradoTxt;
                            }
                            ?></label>
                        <input type="radio" id="circolareVisione"
                               name="circolare" value="self">
                        <label for="circolareVisione">tutti</label>

                    </form>


                    <table>
                        <tr>
                            <th>Circolare</th>
                        </tr>
                        <tr>
                            <td>NOME CIRCOLARE</td>
                        </tr>
                    </table>
                </div>

                <div id="crea_circolari">
                    <h3 style="text-align: center">Creazione Circolari</h3>
                    <form method="get">

                        <fieldset>
                        <label>
                            Titolo <input type="text" name="titolo">
                        </label><br>
                            <label>
                                Allegato <input type="file" name="pdf">
                            </label><br>
                            <input checked type="radio" id="circolareCrea"
                                   name="circolareCrea" value="studenti">
                            <label for="circolareCrea">Studenti</label>
                            <input type="radio" id="circolareCrea1"
                                   name="circolareCrea" value="docenti">
                            <label for="circolareCrea1">Docenti</label>
                            <input type="radio" id="circolareCrea2"
                                   name="circolareCrea" value="Entrambi">
                            <label for="circolareCrea2">Entrambi</label><br>
                            <input type="submit" value="invia" name="invia">
                        </fieldset>
                    </form>
                </div>

                <div id="crea_utente">
                    <h3 style="text-align: center">Creazione Utente</h3>
                    <form method="get">

                        <fieldset>
                            <label>
                                Nome <input type="text" name="nome">
                            </label><br>
                            <label>
                                Cognome <input type="text" name="cognome">
                            </label><br>
                            <label>
                                Data Nascita <input type="date" name="data">
                            </label><br>
                            <label>
                                Email <input type="email" name="email">
                            </label><br>
                            <label>
                                Foto <input type="file" name="foto">
                            </label><br>
                            <input checked type="radio" id="creaUtente"
                                   name="circolareCrea" value="studenti">
                            <label for="crea_utente">Studente</label>
                            <input type="radio" id="crea_utente1"
                                   name="circolareCrea" value="docenti">
                            <label for="crea_utente1">Docente</label><br>
                            <input type="submit" value="invia" name="invia">
                        </fieldset>
                    </form>
                </div>

                <div id="login">
                    <h3 style="text-align: center">Login</h3>
                    <form method="post" action="index.php">

                        <fieldset>
                            <label>
                                email <input type="text" name="email">
                            </label><br>
                            <label>
                                password <input type="password" name="password">
                            </label><br>
                            <input type="submit" value="loginBut" name="loginBut">
                        </fieldset>
                    </form>
                </div>

                <div id="conferma">
                    <h3 style="text-align: center">Conferma Registrazione</h3>
                    <form method="get">

                        <fieldset>
                            <label>
                                email <input type="text" name="email">
                            </label><br>
                            <label>
                                password Temporanea <input type="password" name="password_temp">
                            </label><br>
                            <label>
                                password Definitiva <input type="password" name="password_def">
                            </label><br>
                            <input type="submit" value="invia" name="invia">
                        </fieldset>
                    </form>
                </div>

            </div>


        </div>
        <div class="top">
            <div>
                <div class="logo">
                    Fauser
                    <span class="small">&laquo;</span>
                </div>
                <div class="content">
                    <div class="user">
                        <i class="fa fa-bell fa-2x" id="notifiche">
                            <span><?php
                                echo random_int(0, 100);
                                ?></span>
                        </i>
                        <div id="utente">
                            <span id="name"><a href="#"> Ciao, <span><?php
                                        if ($nome != "") echo $nome;
                                        ?></span></a></span>
                            <div id="profilepic"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar">
            <nav id="left">
                <ul>
                    <!-- Mettere questo class="active" a seconda della pagina -->
                    <li><a href="?">Home<i class="fa fa-home fa-2x"></i></a><span></span></li>
                    <li><a href="?leggi_circolari">Visualizza Circolari<i class="fa fa-envelope fa-2x"></i></a><span></span></li>
                    <li><a href="?crea_circolari">Crea Circolari<i class="fa fa-book fa-2x"></i></a><span></span></li>
                    <li><a href="?account=1">Nuovo Account<i class="fa fa-users fa-2x"></i></a><span></span></li>
                    <?php
                    if ($nome == "") {
                        echo '<li><a href="?login=1">Login<i class="fa fa-sign-in fa-2x"></i></a><span></span></li>';
                    } else echo '<li><a href="?logout=1">LogOut<i class="fa fa-sign-out fa-2x"></i></a><span></span></li>';
                    ?>
                </ul>
            </nav>
        </div>
    </div>
    </body>
</html>