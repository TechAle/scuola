<?php

session_start();

require_once "classes/Auth.php";
require_once "classes/Util.php";
require_once "classes/Member.php";

$auth = new Auth();
$db_handle = new DBController();
$util = new Util();
$member = new Member();

require_once "classes/authCookieSessionValidate.php";

$ver = false;

if(isset($_SESSION['admin'])) {
    $ver = true;
    if ($_SESSION['admin'] != true) {
        $util->redirect("dashboard.php");
    }
}

if(isset($_COOKIE['admin'])) {
    $ver = true;
    if ($_COOKIE['admin'] != true) {
        $util->redirect("dashboard.php");
    }
}

if(!$ver)
    $util->redirect("dashboard.php");

if (isset($_SESSION["member_id"]))
    $current_id = $_SESSION["member_id"];
else
    $current_id = $member->getId($_COOKIE['member_login']);

if (isset($_POST["ignora"])) {
    $query = "UPDATE photo SET segnalazione = 0 WHERE photo_id = ?";
    $paramType = 'i';
    $paramValue = array(
        $_POST["photo_id"]
    );
    $db_handle->update($query, $paramType, $paramValue);
}

if (isset($_POST["nascondi"])) {
    $query = "UPDATE photo SET hidden = 1 WHERE photo_id = ?";
    $paramType = 'i';
    $paramValue = array(
        $_POST["photo_id"]
    );
    $db_handle->update($query, $paramType, $paramValue);

    $id = $member->getIdFromPhoto($_POST["photo_id"]);

    $member->bloccaMembro24($id);

    $query = "INSERT INTO message (context, sender_id, receiver_id) VALUES (?, ?, ?)";
    $messaggio =  "Sei stato bloccato per 24 ore a causa di una segnalazione ad una tua foto";
    $paramType = 'sii';
    $paramValue = array(
        $messaggio,
        $current_id,
        $id
    );
    $db_handle->insert($query, $paramType, $paramValue);
}

if (isset($_POST["espelli"])) {
    $id = $member->getIdFromPhoto($_POST["photo_id"]);
    $query = "UPDATE photo SET hidden = 1 WHERE member_id = ?";
    $paramType = 'i';
    $paramValue = array(
        $id
    );
    $db_handle->update($query, $paramType, $paramValue);
    $db_handle->baseUpdate('UPDATE members SET is_locked = 1 WHERE member_id = '.$id. ';');

    require_once "classes/mail.php";

    $mail = $db_handle->runBaseQuery("SELECT member_email FROM members WHERE member_id = ".$id. ";");

    $oggetto = "Espulsione Concorso Fotografico";
    $corpo = 'Le comunichiamo che è stato espulso dal concorso fotografico per comportamento inopportuno.';

    $successo = InviaEmail("Concorso Fotografico", $mail[0]['member_email'], $oggetto, $corpo);
}

$query = "SELECT 
            members.member_id,
            member_email,
            SUM(1_stella + 2_stelle + 3_stelle + 4_stelle + 5_stelle) AS 'Voti totali'
          FROM photo
          INNER JOIN members ON photo.member_id = members.member_id
          GROUP BY photo.member_id
          ORDER BY 'Voti totali' DESC
          LIMIT 10;
          
          ";

$righe = $db_handle->runBaseQuery("SELECT * FROM members");
$foto = $db_handle->runBaseQuery("SELECT * FROM photo WHERE segnalazione = true;");
$classifica = $db_handle->runBaseQuery($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- MetaData -->


    <!-- Better mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Concorso - Admin</title>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    .tdTop {
        text-align: center;
    }
    #body {
        height: 100%;
        overflow-y: scroll;
        overflow-x: hidden;
        padding: 0;
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

    .row {
        overflow-x: scroll;
    }
</style>
<div id="content">
    <!-- Since we have an header that is absolute, we have to simulate his height, and we'll do this is a padding  -->
    <div id="padding-header">
    </div>
    <form action="scaricapdf.php" style="text-align: center; margin-bottom: 15px">
        <input type="submit" value="Stampa PDF" />
    </form>
    <div id="body" class="container">
        <div class="col-12" style="background-color: lightgray;">

            <div class="row">
                <table class="table table-bordered table-dark">
                    <thead>
                    <tr>
                        <td colspan="10" class="tdTop">Membri</td>
                    </tr>
                    <tr>
                        <td>id</td><td>Cognome</td><td>Nome</td><td>Email</td><td>Token</td><td>Foto Profilo</td><td>Verificato</td><td>Admin</td><td>Bloccato</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ver = 'no';
                    $ad = 'no';
                    $lck = 'no';

                    if($righe != null)
                    {
                        $lungh = count($righe);
                        for($i = 0; $i < $lungh; $i++)
                        {

                            if($righe[$i]['member_verified'] == 1)
                                $ver = 'si';
                            else
                                $ver = 'no';

                            if($righe[$i]['is_admin'] == 1)
                                $ad = 'si';
                            else
                                $ad = 'no';
                            if($righe[$i]['is_locked'] == 1)
                                $lck = 'si';
                            else
                                $lck = 'no';



                            echo '<tr><td>'.$righe[$i]['member_id'].'</td><td>'.$righe[$i]['member_surname'].'</td><td>'.$righe[$i]['member_name'].'</td><td>'.$righe[$i]['member_email'].'</td><td>'.$righe[$i]['member_token'].'</td><td>'.$righe[$i]['member_profile_picture'].'</td><td>'.$ver.'</td><td>'.$ad.'</td> <td>'.$lck.'</td></tr><br>';
                        }

                    }

                    ?>
                    <!--
                    <tr>
                        <td>1</td><td>ale</td><td>ale</td><td>a@gmail.com</td><td>a#ffdsa</td><td>aa.png</td><td>si</td><td>no</td><td>no</td>
                    </tr>-->
                    </tbody>
                </table>
            </div>

            <div class="row">
                <table class="table table-bordered table-dark">
                    <thead>
                    <tr>
                        <td colspan="10" class="tdTop">Foto Segnalate</td>
                    </tr>
                    <tr>
                        <td>id</td><td>Nome</td><td>Descrizione</td><td>Media</td><td>Id Foto</td><td>Nascosta</td><td>Foto</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $hidden = 'no';

                    if($foto != null)
                    {
                        $lungh = count($foto);
                        for($i = 0; $i < $lungh; $i++)
                        {
                            if($foto[$i]['segnalazione'] == 1) {

                                if ($foto[$i]['hidden'] == 1)
                                    $hidden = 'si';
                                else
                                    $hidden = 'no';


                                echo '<tr><td>' . $foto[$i]['photo_id'] . '</td><td>' . $foto[$i]['file_name'] . '</td><td>' . $foto[$i]['description'] . '</td><td>' . $foto[$i]['media'] . '</td><td>' . $foto[$i]['member_id'] . '</td><td>' . $hidden . '</td><td style=" height:10%;"><img style="height: 100px"  alt="' . $foto[$i]['file_name'] . '" src="imgs/' . $foto[$i]['file_name'] . '"></a></td></tr><br>';

                                //Nascondi (MANCA MSG DI BAN PRIVATO)
                                echo "<tr><td style='text-align: center'><form id='nascondi' method='post'><input type='hidden' name='photo_id' value='" . $foto[$i]["photo_id"] . "'/><input type='hidden' name='nascondi' value='1'/><input type='submit' name='submit_nascondi' value='Nascondi foto'/></form></td>";

                                //Ignora segnalazione
                                echo "<td style='text-align: center'><form id='ignora' method='post'><input type='hidden' name='photo_id' value='" . $foto[$i]["photo_id"] . "'/><input type='hidden' name='ignora' value='1'/><input type='submit' name='ignora' value='Ignora Segnalazione'/></form></td>";

                                //Espelli utente
                                echo "<td style='text-align: center'><form id='espelli' method='post'><input type='hidden' name='photo_id' value='" . $foto[$i]["photo_id"] . "'/><input type='hidden' name='espelli' value='1'/><input type='submit' name='espelli' value='Espelli Membro'/></form></td>";


                                echo "</tr>";
                            }



                        }

                    }
                    ?>
                    <!--
                    <tr>

                        <td>1</td><td>ale.png</td><td>ale</td><td>2</td><td>2</td><td>no</td><td>
                            <img src="./img/background.png" style="height: 100px ">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="tdTop"><button>Nascondi</button></td>
                        <td colspan="2" class="tdTop"><button>Ignora</button></td>
                        <td colspan="2" class="tdTop"><button>Espelli</button></td>
                    </tr>
                    <tr>
                        <td>1</td><td>ale.png</td><td>ale</td><td>2</td><td>2</td><td>no</td><td>
                            <img src="./img/background.png" style="height: 100px ">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="tdTop"><button>Nascondi</button></td>
                        <td colspan="2" class="tdTop"><button>Ignora</button></td>
                        <td colspan="2" class="tdTop"><button>Espelli</button></td>
                    </tr>-->
                    </tbody>
                </table>
            </div>

            <div class="row">
                <table class="table table-bordered table-dark">
                    <thead>
                    <tr>
                        <td colspan="10" class="tdTop">Votazioni</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <?php if($classifica != null){ ?>
                                <div class="sign-up-container" style="position: center;">
                                    <canvas id="myChart"></canvas>
                                </div>
                            <?php } ?>

                            <script>
                                // === include 'setup' then 'config' above ===
                                const DATA_COUNT = 7;
                                const NUMBER_CFG = {count: DATA_COUNT, min: -100, max: 100};

                                const labels = [
                                    <?php
                                    for($i = 0; $i < count($classifica); $i++)
                                        echo "'".$classifica[$i]['member_email']."',"; ?>
                                ];
                                const data = {
                                    labels: labels,
                                    datasets: [
                                        {
                                            label: 'Voti totali',

                                            data: [

                                                <?php
                                                for($i = 0; $i < count($classifica); $i++)
                                                    echo $classifica[$i]['Voti totali'].","; ?>



                                            ],

                                            borderColor: 'rgb(255, 99, 132)',
                                            backgroundColor: '<?php echo $util->randomHex(); ?>',
                                        },

                                    ]
                                };


                                const config = {
                                    type: 'bar',
                                    data: data,
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                            },
                                            title: {
                                                display: true,
                                                text: 'Numero maggiore di votazioni (Top 10)'
                                            }
                                        }
                                    },
                                };



                                var myChart = new Chart(
                                    document.getElementById('myChart'),
                                    config
                                );
                            </script>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <?php

            $logs_photo = $db_handle->runBaseQuery("
    SELECT log_vote.member_id, member_email, log_vote.photo_id, log_vote.vote, file_name, data_log
    FROM log_vote
    INNER JOIN members
    ON log_vote.member_id = members.member_id
    INNER JOIN photo
    ON log_vote.photo_id = photo.photo_id
    ORDER BY data_log DESC;
    
    
    ");

            ?>


            <div class="row">
                <table class="table table-bordered table-dark">
                    <thead>
                    <tr>
                        <td colspan="10" class="tdTop">Storico Votazioni</td>
                    </tr>
                    <tr>
                        <td>Utente</td><td>Foto</td><td>Voto</td><td>Data</td><td>Id Utente</td><td>ID Foto</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    if($logs_photo != null)
                    {
                        $lungh = count($logs_photo);
                        for($i = 0; $i < $lungh; $i++)
                        {
                            echo '<tr><td>'.$logs_photo[$i]['member_email'].'</td><td>'.$logs_photo[$i]['file_name']. ' </td><td>'.$logs_photo[$i]['vote']. ' </td><td>'.$logs_photo[$i]['data_log'].' </td><td>'.$logs_photo[$i]['member_id'].' </td><td>'.$logs_photo[$i]['photo_id'].' </td></tr>';
                        }
                        echo '</table>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>



            <div class="row">
                <table class="table table-bordered table-dark">
                    <thead>
                    <tr>
                        <td colspan="10" class="tdTop">Storico Votazioni</td>
                    </tr>
                    <tr>
                        <td>Utente</td><td>Foto</td><td>Data</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>a@gmail.com</td><td>a.png</td><td>5-5-5</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <table class="table table-bordered table-dark">
                    <thead>
                    <tr>
                        <td colspan="10" class="tdTop">Storico Immagini</td>
                    </tr>
                    <tr>
                        <td>Utente</td><td>Immagine</td><td>Data</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT * FROM log_carica_foto ORDER BY data_log DESC";
                    $result = $db_handle->runBaseQuery($query);

                    if ($result != null)
                    {
                        foreach ($result as $riga) {
                            echo "<tr><td>".$member->getEmailByID($riga["member_id"])."</td><td>".$member->getPhotoById($riga["photo_id"])."</td><td>".$riga["data_log"]."</td></tr>";
                        }
                        echo '</table>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <table class="table table-bordered table-dark">
                    <thead>
                    <tr>
                        <td colspan="10" class="tdTop">Storico Descrizione</td>
                    </tr>
                    <tr>
                        <td>Utente</td><td>Descrizione</td><td>Data</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT * FROM log_foto_update ORDER BY data_log DESC";
                    $result = $db_handle->runBaseQuery($query);

                    if ($result != null)
                    {
                        foreach ($result as $riga) {
                            echo "<tr><td>Utente: ".$member->getEmailByID($riga["member_id"])."</td><td>".$riga["description"]."</td><td>".$riga["data_log"]."</td></tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <table class="table table-bordered table-dark">
                    <thead>
                    <tr>
                        <td colspan="10" class="tdTop">Storico Segnalazioni</td>
                    </tr>
                    <tr>
                        <td>Utente</td><td>Id</td><td>Data</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT * FROM log_segnalazioni ORDER BY data_log DESC";
                    $result = $db_handle->runBaseQuery($query);

                    if ($result != null)
                    {
                        foreach ($result as $riga) {
                            echo "<tr><td>".$member->getEmailByID($riga["member_id"])."</td><td>".$riga["photo_id"]."</td><td>".$riga["data_log"]."</td></tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <table class="table table-bordered table-dark">
                    <thead>
                    <tr>
                        <td colspan="10" class="tdTop">Storico Commenti</td>
                    </tr>
                    <tr>
                        <td>Utente</td><td>Id</td><td>Data</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT * FROM log_commenti ORDER BY data_log DESC";
                    $result = $db_handle->runBaseQuery($query);

                    if ($result != null)
                    {
                        foreach ($result as $riga) {
                            echo "<tr><td>".$member->getEmailByID($riga["member_id"])."</td><td>".$riga["photo_id"]."</td><td>".$riga["data_log"]."</td></tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <table class="table table-bordered table-dark">
                    <thead>
                    <tr>
                        <td colspan="10" class="tdTop">Storico Foto Eliminate</td>
                    </tr>
                    <tr>
                        <td>Utente</td><td>Id</td><td>Data</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT * FROM log_elimina_foto ORDER BY data_log DESC";
                    $result = $db_handle->runBaseQuery($query);

                    if ($result != null)
                    {
                        foreach ($result as $riga) {
                            echo "<tr><td>".$member->getEmailByID($riga["member_id"])."</td><td>".$riga["photo_id"]."</td><td>".$riga["data_log"]."</td></tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <table class="table table-bordered table-dark">
                    <thead>
                    <tr>
                        <td colspan="10" class="tdTop">Storico Messaggi</td>
                    </tr>
                    <tr>
                        <td>Mittente</td><td>Destinatario</td><td>Data</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT * FROM log_messaggi ORDER BY data_log DESC";
                    $result = $db_handle->runBaseQuery($query);

                    if ($result != null)
                    {
                        foreach ($result as $riga) {
                            echo "<tr><td>".$member->getEmailByID($riga["sender_id"])."</td><td>".$member->getEmailByID($riga["receiver_id"])."</td><td>".$riga["data_log"]."</td></tr>";
                        }
                    } else
                    ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>




</body>
</html>