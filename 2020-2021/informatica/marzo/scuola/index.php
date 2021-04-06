<?php

use PHPMailer\PHPMailer\PHPMailer;

session_start();
$db_host = "";
$db_user = "";
$db_pass = "";
$db_name = "";
include "parametri.php";
$conn = new mysqli($db_host,$db_user,$db_pass, $db_name) or die("Errore connessione server");

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (isset($_GET["messaggio"])) {
    echo "<script>alert('Messaggio: ".$_GET['messaggio']."')</script>";
}

if (isset($_POST["invia_password"])) {
    if (isset($_SESSION["grado"])) {
        if ($_SESSION["grado"] != "")
            header('Location: '.$_SERVER['PHP_SELF'] . "?messaggio=errore:area_non_permessa");
    }
    $id = $conn->real_escape_string($_POST["id"]);
    $password = $conn->real_escape_string($_POST["password"]);
    $token = $conn->real_escape_string($_POST["token"]);
    $query = "call abilita_utenti('".$id."', '".$password."', '".$token."', @success);";
    $ris = $conn->query($query);
    $value = $ris->fetch_row()[0];
    if ($value == 0)
        header('Location: '.$_SERVER['PHP_SELF'] . "?messaggio=errore:nome_non_trovato");
    else header('Location: '.$_SERVER['PHP_SELF'] . "?messaggio=info:registrazione_effettuata");
}

if (isset($_POST["invia_crea_utente"])) {
    if ($_SESSION["grado"] == 1) {
        // Creo account
        $string = generateRandomString();
        $query = "call aggiungi_utenti('".$_POST['nome']."', '".$_POST['cognome']."', '".$_POST['data']."', '".$_POST['email']."', '".$_POST['circolareCrea']."', '".$string."');";
        $conn->query($query);
        // Keys: name type tmp_name error size
        $file = $_FILES["foto"];
        $estenzioni_consentite = array("png");
        if (in_array($ext = strtolower(explode('.', $file["name"])[array_key_last(explode('.', $file["name"]))]), $estenzioni_consentite)) {
            move_uploaded_file($file["tmp_name"], "./usr/" . $_POST["email"] . ".png");
        }
        if (false) {
            // Invio email
            require "./phpmailer/PHPMailer.php";
            require "./phpmailer/SMTP.php";
            require "./phpmailer/Exception.php";

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

            $sql = "select idutente, token from UTENTI where email like " . $conn->real_escape_string($_POST["email"]);
            $result = $conn->query($sql);
            $value = $result->fetch_row();


            $id = $value[0];
            $token = $value[1];
            $mail->Subject = "Registrazione";
            $mail->Body = "<h1>Registrazione</h1><br>" . "Si può registrare inserendo id " . $id . " e token" . $token;
            $mail->AltBody = "Si può registrare inserendo id " . $id . " e token" . $token;

            try {
                $mail->send();
            } catch (Exception $e) {
                header('Location: ' . $_SERVER['PHP_SELF'] . "?messaggio=errore:invio_email");
            }
        }
        header('Location: '.$_SERVER['PHP_SELF'] . "?messaggio=info:controllare_email");

    } else header('Location: '.$_SERVER['PHP_SELF'] . "?messaggio=errore:area_non_permessa");
}

if (isset($_POST["invia_creazione"])) {
    if ($_SESSION["grado"] == 2) {
        $titolo = $conn->real_escape_string($_POST["titolo"]);
        $diretto = $conn->real_escape_string($_POST["circolareCrea"]);
        // Creo account
        $query = "call aggiungi_circolari('".$titolo."', '".$diretto."');";
        $conn->query($query);
        // Keys: name type tmp_name error size
        $file = $_FILES["pdf"];
        $estenzioni_consentite = array("pdf");
        if (in_array($ext = strtolower(explode('.', $file["name"])[array_key_last(explode('.', $file["name"]))]), $estenzioni_consentite)) {
            move_uploaded_file($file["tmp_name"], "./pdf/" . $titolo . ".pdf");
        }
        header('Location: '.$_SERVER['PHP_SELF'] . "?messaggio=info:pdf_creato");

    } else header('Location: '.$_SERVER['PHP_SELF'] . "?messaggio=errore:area_non_permessa");
}

if (isset($_GET["leggi_circolari"])) {
    if (isset($_SESSION["grado"])) {
        $val = $_SESSION["grado"];
        if ($val != 3 && $val != 4) {
            header('Location: '.$_SERVER['PHP_SELF'] . "?messaggio=errore:area_non_permessa");
        }
    }
}

if (isset($_GET["crea_circolari"])) {
    if (isset($_SESSION["grado"])) {
        $val = $_SESSION["grado"];
        if ($val != 2) {
            header('Location: '.$_SERVER['PHP_SELF'] . "?messaggio=errore:area_non_permessa");
        }
    }
}

if (isset($_GET["crea_utente"])) {
    if (isset($_SESSION["grado"])) {
        $val = $_SESSION["grado"];
        if ($val != 1) {
            header('Location: '.$_SERVER['PHP_SELF'] . "?messaggio=errore:area_non_permessa");
        }
    }
}

if (isset($_GET["registrazione"])) {
    if (isset($_SESSION["grado"])) {
        if ($_SESSION["grado"] != "")
            header('Location: '.$_SERVER['PHP_SELF'] . "?messaggio=errore:area_non_permessa");
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
    if (isset($_SESSION["grado"])) {
        if ($_SESSION["grado"] != "")
            header('Location: '.$_SERVER['PHP_SELF'] . "?messaggio=errore:area_non_permessa");
    }
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link href='https://fonts.googleapis.com/css?family=Comfortaa:400,300,700|Open+Sans:100,400,300,600'
              rel='stylesheet' type='text/css'>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <script type="text/javascript" src="script.js"></script>
        <title>Fauser</title>
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
            #registrazione {
                display: <?php
                if (isset($_GET["registrazione"])) {
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
                               name="circolare" value="<?php
                                if ($gradoTxt != "") {
                                    echo $gradoTxt;
                                }
                               ?>">
                        <label for="circolareTutti"><?php
                            if ($gradoTxt != "") {
                                echo $gradoTxt;
                            }
                            ?></label>
                        <input type="radio" id="circolareVisione"
                               name="circolare" value="Entrambi">
                        <label for="circolareVisione">Entrambi</label>

                    </form>


                    <div id="ciao">
                        <?php
                        $ric = "";
                        $output = "";
                        if (isset($_POST["volere"])) {
                            $ric = $_POST["volere"];
                            if ($ric == "Entrambi") {
                                if ($gradoTxt == "Studente")
                                    $volere = 4;
                                else
                                    $volere = 3;
                                $query = "select * from CIRCOLARI c where c.diretto = -1 or c.diretto = " . $volere;
                            } else {
                                if ($gradoTxt == "Studente")
                                    $volere = 4;
                                else
                                    $volere = 3;
                                $query = "select * from CIRCOLARI c where c.diretto = " . $volere;
                            }
                            $ris = $conn->query($query);
                            if ($ris) {
                                $numRighe = $ris->num_rows;
                                echo '<table>
                                        <tr>
                                            <th>Numero</th>
                                            <th>Nome</th>
                                        </tr>';
                                while ($row = $ris->fetch_row()) {
                                    echo "<tr><th>".$row[0]."</th><th><a href='./pdf/".$row[1].".pdf'>".$row[1]."</a></th></tr>";

                                }
                                echo"</table>";
                            }
                        }
                        ?>
                    </div>

                    <table id="risultato">

                        <?php

                        if ($gradoTxt != "") {
                            if ($output == "") {
                                if ($ric == "")
                                    $ric = $gradoTxt;
                                $query = "";
                                if ($ric == "Entrambi") {
                                    if ($gradoTxt == "Studente")
                                        $volere = 4;
                                    else
                                        $volere = 3;
                                    $query = "select * from CIRCOLARI c where c.diretto = -1 or c.diretto = " . $volere;
                                } else {
                                    if ($gradoTxt == "Studente")
                                        $volere = 4;
                                    else
                                        $volere = 3;
                                    $query = "select * from CIRCOLARI c where c.diretto = " . $volere;
                                }
                                $ris = $conn->query($query);
                                if ($ris) {
                                    $numRighe = $ris->num_rows;
                                    echo sprintf('
                                        <tr>
                                            <th>Numero</th>
                                            <th>Nome</th>
                                        </tr>');
                                    while ($row = $ris->fetch_row()) {
                                        echo sprintf("<tr><th>%s</th><th><a href='./pdf/%s.pdf'> %s</a></th></tr>", $row[0], $row[1], $row[1]);

                                    }
                                    echo sprintf('');
                                }
                            } else {
                                echo $output;
                            }
                        }
                        ?>
                    </table>



                    <script>
                        var a;

                        $(document).ready(function () {
                            $('input:radio[name=circolare]').change(function () {
                                var output = this.value;
                                $.ajax({
                                    type: "POST", url: "index.php?leggi_circolari",
                                    data: 'volere=' + output,
                                    success: function (risposta) {
                                        var content = $( risposta ).find( "#risultato" );
                                        a = risposta;
                                        $( "#risultato" ).empty().append( content );
                                    }
                                });
                            });
                        });

                        /*
                        $(document).ready(function(){
                            $("#circolareTutti").change(function(){
                                var output = this.value;
                                $.ajax({
                                    type: "POST", url: "index.php?registrazione",
                                    data: 'volere=' + output,
                                    success: function (risposta) {
                                        var content = $( risposta ).find( "#risultato" );
                                        a = risposta;
                                        $( "#risultato" ).empty().append( content );
                                    }
                                });
                            });
                        });*/

                    </script>
                </div>



                <div id="crea_circolari">
                    <h3 style="text-align: center">Creazione Circolari</h3>
                    <form method="post" action="index.php" enctype='multipart/form-data'>

                        <fieldset>
                        <label>
                            Titolo <input type="text" name="titolo">
                        </label><br>
                            <label>
                                Allegato <input type="file" name="pdf">
                            </label><br>
                            <input checked type="radio" id="circolareCrea"
                                   name="circolareCrea" value="Studente">
                            <label for="circolareCrea">Studente</label>
                            <input type="radio" id="circolareCrea1"
                                   name="circolareCrea" value="Docente">
                            <label for="circolareCrea1">Docente</label>
                            <input type="radio" id="circolareCrea2"
                                   name="circolareCrea" value="Entrambi">
                            <label for="circolareCrea2">Entrambi</label><br>
                            <input type="submit" value="invia" name="invia_creazione">
                        </fieldset>
                    </form>
                </div>

                <div id="crea_utente">
                    <h3 style="text-align: center">Creazione Utente</h3>
                    <form method="post" action="index.php" enctype='multipart/form-data'>

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
                                Foto (.png) <input type="file" name="foto">
                            </label><br>
                            <input checked type="radio" id="creaUtente"
                                   name="circolareCrea" value="Studente">
                            <label for="crea_utente">Studente</label>
                            <input type="radio" id="crea_utente1"
                                   name="circolareCrea" value="Docente">
                            <label for="crea_utente1">Docente</label><br>
                            <input type="radio" id="crea_utente2"
                                   name="circolareCrea" value="Presidenza">
                            <label for="crea_utente2">Presidenza</label><br>
                            <input type="submit" value="invia" name="invia_crea_utente">
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

                <div id="registrazione">
                    <h3 style="text-align: center">Conferma Registrazione</h3>
                    <form method="post" action="index.php">

                        <fieldset>
                            <label>
                                id <input type="text" name="id">
                            </label><br>
                            <label>
                                password <input type="password" name="password">
                            </label><br>
                            <label>
                                token <input type="password" name="token">
                            </label><br>
                            <input type="submit" value="invia" name="invia_password">
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
                    <li><a href="?crea_utente">Nuovo Account<i class="fa fa-users fa-2x"></i></a><span></span></li>
                    <li><a href="?registrazione">Registrazione<i class="fa fa-users fa-2x"></i></a><span></span></li>
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