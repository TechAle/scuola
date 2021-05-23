<?php
require_once "classes/Util.php";
require_once "classes/Member.php";
require_once "classes/DBController.php";

session_start();

$util = new Util();
$member = new Member();
$db = new DBController();
$messaggio = "";

$query = "SELECT member_verified FROM members WHERE member_email = ?";

if (isset($_SESSION['mail']))
    $mail = $_SESSION['mail'];
else {
    $mail = $_COOKIE['member_login'];
    $ris = $db->select($query, "s", array($_COOKIE['member_login']));
    if($ris[0]['member_verified'] == false)
        $util->redirect("index.php");
}

if (isset($_SESSION['verified'])) {
    if (!$_SESSION['verified']) {
        $util->redirect("index.php");
    }
}

//Per caricare
if(isset($_POST['carica'])) {
    if (isset($_POST['desc'])) {
        echo print_r($_FILES);
        $risposta = $member->caricaImmagine($mail, $_FILES['picture'], $_POST['desc']);

    }
}

//Per eliminare
if(isset($_POST['rimuovi'])) {
    if (isset($_POST['checkbox'])) {
        $risposta = $member->cancellaImmagine($_POST['checkbox']);
    }
}

//Per modifica
if(isset($_POST['edit'])) {
    if (isset($_POST['checkbox'])) {
        $risposta = $member->editImmagine($_POST['checkbox'], $_POST['desc']);
    }
}

$righe = $member->getFoto($mail);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- MetaData -->


    <!-- Better mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Concorso - Dashboard</title>
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

<style>
    .scelte {
        background-color: #005eff;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        text-align: center;
        padding-right: 5px;
        color: white;
        margin-bottom: 10px;
    }
    #loginScelta {
        height: 75px;
    }
    #registrazioneScelta {
        height: 125px;
    }
    .popover {
        display: none;
    }
    .popover {
        display: none;
    }
    .Titolo {
        text-align: center;
        padding-top: 10px;
        font-size: 75px;
        margin-bottom: 0;
    }
    .loginReg {
        height: 100%;

    }
    .cointainerForm {
        height: 70%;
        margin-left: 20px;
        margin-right: 20px;
    }
    .sottoTitolo {
        text-align: center;
        font-size: 30px;
    }

    form{
        padding: 0 2em;
    }
    .form__input{
        width: 100%;
        border:0px solid transparent;
        border-radius: 0;
        border-bottom: 1px solid #aaa;
        padding: 1em .5em .5em;
        padding-left: 2em;
        outline:none;
        margin:1.5em auto;
        transition: all .5s ease;
    }
    .form__input:focus{
        border-bottom-color: #005eff;
        box-shadow: 0 0 5px rgba(0,80,80,.4);
        border-radius: 4px;
    }
    .btn{
        transition: all .5s ease;
        width: 70%;
        border-radius: 30px;
        color:#005eff;
        font-weight: 600;
        background-color: #fff;
        border: 1px solid #005eff;
        margin-top: 1.5em;
        margin-bottom: 1em;
    }
    .btn:hover, .btn:focus{
        background-color: #005eff;
        color:#fff;
    }

    @keyframes fadeout {
        from { opacity: 1; }
        to   { opacity: 0; }
    }

    /* Firefox < 16 */
    @-moz-keyframes fadeout {
        from { opacity: 1; }
        to   { opacity: 0; }
    }

    /* Safari, Chrome and Opera > 12.1 */
    @-webkit-keyframes fadeout {
        from { opacity: 1; }
        to   { opacity: 0; }
    }

    /* Internet Explorer */
    @-ms-keyframes fadeout {
        from { opacity: 1; }
        to   { opacity: 0; }
    }

    /* Opera < 12.1 */
    @-o-keyframes fadeout {
        from { opacity: 1; }
        to   { opacity: 0; }
    }


    /* Fadin */
    @keyframes fadein {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    /* Firefox < 16 */
    @-moz-keyframes fadein {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    /* Safari, Chrome and Opera > 12.1 */
    @-webkit-keyframes fadein {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    /* Internet Explorer */
    @-ms-keyframes fadein {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    /* Opera < 12.1 */
    @-o-keyframes fadein {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    .regReg {
        display: none;
        overflow-y: scroll;
    }
    .container{
        margin-top:20px;
    }
    .image-preview-input {
        position: relative;
        overflow: hidden;
        margin: 0px;
        color: #333;
        background-color: #fff;
        border-color: #ccc;
    }
    .image-preview-input input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    .image-preview-input-title {
        margin-left:2px;
    }
    #dynamic {
        width: 100px;
    }

</style>
<div id="content">
    <!-- Since we have an header that is absolute, we have to simulate his height, and we'll do this is a padding  -->
    <div id="padding-header">
    </div>
    <div id="body" class="container">
        <div class="col-12" style="background-color: lightgray;">

            <div class="row">
                <table class="table table-bordered table-dark">
                    <tbody>
                    <tr>
                        <td colspan="3" style="text-align: center">Carica Foto</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <form  name="sign-up" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                <input id="inputFile picture" type="file" name="picture"
                                        accept="image/*" required class="form-control image-preview-filename" >
                                <center>
                                    Descrizione
                                </center>
                                <textarea style="resize: none; width: 50%" cols="33" name="desc"  id="desc" maxlength="255" required > </textarea>
                                <center>
                                    <input type="hidden" name="carica" id="carica" value="carica"/>
                                    <input class="btn" type="submit" name="signup-btn"
                                           id="signup-btn" value="Carica">
                                </center>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <table class="table table-bordered table-dark">
                    <tbody>
                    <tr>
                        <td colspan="3" style="text-align: center">Rimuovi Foto</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <form  name="sign-up" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                <center>
                                    <?php

                                    if($righe != null)
                                    {
                                        $lungh = count($righe);
                                        for($i = 0; $i < $lungh; $i++)
                                        {
                                            echo '<input type="checkbox" name="checkbox[]" value="'.$righe[$i]['photo_id'].'">'.$righe[$i]['file_name'].' <br>';
                                        }
                                        echo "<br>";
                                    }

                                    ?>
                                </center>
                                <center>
                                    <input type="hidden" name="rimuovi" id="rimuovi" value="rimuovi" />
                                    <input class="btn" type="submit" name="signup-btn"
                                           id="signup-btn" value="Rimuovi">
                                </center>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <table class="table table-bordered table-dark">
                    <tbody>
                    <tr>
                        <td colspan="3" style="text-align: center">Modifica Descrizione</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <form  name="sign-up" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                <center>
                                    <?php
                                    if($righe != null)
                                    {
                                        $lungh = count($righe);
                                        for($i = 0; $i < $lungh; $i++)
                                        {
                                            echo '<input type="radio" name="checkbox[]" value="'.$righe[$i]['photo_id'].'">'.$righe[$i]['file_name'].' <br>';
                                        }
                                        echo "<br>";
                                    }
                                    ?>
                                </center>
                                <center>
                                    Descrizione
                                </center>
                                <textarea style="resize: none; width: 50%" cols="33" name="desc"  id="desc" maxlength="255" required > </textarea>
                                <center>
                                    <input type="hidden" name="edit" id="edit" value="edit" />
                                    <input class="btn" type="submit" name="signup-btn"
                                           id="signup-btn" value="Modifica">
                                </center>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <style>
                td {
                    text-align: center;
                }
            </style>
            <div class="row">
                <table class="table table-bordered table-dark ">
                    <thead>
                    <tr>
                        <td colspan="3" style="text-align: center">Le mie foto</td>
                    </tr>
                    <tr>
                        <td>Descrizione</td>
                        <td>Nome Immagine</td>
                        <td>Immagine</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    if($righe != null)
                    {
                        $lungh = count($righe);
                        for($i = 0; $i < $lungh; $i++)
                        {
                            echo '<tr><td>'.$righe[$i]['description'].'</td><td>'.$righe[$i]['file_name'].'</td><td style=" height:10%;"><img style="height: 100px"  alt="'.$righe[$i]['file_name'].'" src="imgs/'.$righe[$i]['file_name'].'"></a></td></tr><br>';
                        }

                    }

                    ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php
$messaggio = "";
if (!empty($risposta["status"])) {
    if ($risposta["status"] == "success") {
        $messaggio = $risposta["message"];
    }
}
?>

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