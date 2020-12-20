<?php
session_start();
$nomeSito = "";
include "globali.php";
?>
<html lang="it">
<head>
    <title><?php echo $nomeSito ?> - Admin Login</title>
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
    <li><a href="richiesta.php">Richiesta</a> </li>
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
    <form class="col s12" method="post" action="admin_page.php" enctype="multipart/form-data">
        <?php
        if (!(isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == 1)) {
            echo '<div class="row">
                <div class="input-field col s12">
                    <input placeholder="Username" name="username" id="username" type="text" class="validate">
                    <label for="username">Username</label>
                </div>
            </div><div class="row">
                <div class="input-field col s12">
                    <input placeholder="Email" name="email" id="email" type="text" class="validate">
                    <label for="email">email</label>
                </div>
            </div><div class="row">
                <div class="input-field col s12">
                    <input placeholder="Password" name="password" id="password" type="text" class="validate">
                    <label for="password">password</label>
                </div>
            </div>
            <div class="row">
                <button style="background-color: #F44336; margin-left: 8px" class="btn waves-effect waves-light" type="submit" name="invia">Invia
                    <i class="material-icons right">send</i>
                </button>
                <button style="background-color: #F44336; float: right; margin-right: 8px" class="btn waves-effect waves-light" type="reset" name="reset">Reset
                    <i class="material-icons right">clear</i>
                </button>
            </div>';

        } else {
            echo "<script>location.href = 'admin_page.php' </script>";
        }
        ?>

    </form>
</fieldset>

<!-- nav -->
<div id="footer" style="background-color: #ee6e73; padding-left: 10px">
    <h5 class="white-text"><?php echo $nomeSito?>, copyright 1001-2101</h5>
</div>
</body>
</html>