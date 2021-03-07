<?php
require "parametri.php";
require "get_comune_wiky.php";
$selezionato = "";
$connessione = new mysqli($db_host, $db_user, $db_pass);
$connessione->select_db("comuni");
if (isset($_GET["provincia"])) {
    $provincia = $connessione->real_escape_string($_GET["provincia"]);
} else die("Provincia non trovata");
if (isset($_GET["regione"])) {
    $regione = $connessione->real_escape_string($_GET["regione"]);
} else die("Regione non trovata");
if (isset($_GET["comune"])) {
    $comune = $connessione->real_escape_string($_GET["comune"]);
} else die("Comune non trovato");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" type="text/css" href="testing.css">
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
    <style>
        img {
            width: 700px;
            height: 600px;
        }

        * {
            margin: 0px auto;
            padding: 0px;
            text-aling: center;
        }

        .cont_principal {
            position: absolute;
            height: 100%;
            width: 100%;
            background-color: #90A4AE;
        }

        .cont_text_img {
            position: relative;
            top: 50%;
            margin-top: -175px;
            width: 700px;
            height: 350px;;
            background-color: #fff;
            box-shadow: 0px 10px 25px -5px rgba(0, 0, 0, 0.25);
        }

        .cont_text {
            position: relative;
            float: left;
            width: 50%;
            height: 80%;
            margin: 5%;
            text-align: justify;
        }

        .cont_text_img_act > .cont_text > * {
            opacity: 1;
            left: 0px;
        }

        .cont_text > h1 {
            font-family: 'Open Sans', sans-serif;
            font-weight: 100;
            margin-bottom: 20px;
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;
            -webkit-transition-delay: 1.2s; /* Safari */
            transition-delay: 1.2s;
            opacity: 0;
            position: relative;
            left: -50px;
        }

        .cont_text > p {
            font-family: 'Open Sans', sans-serif;
            font-size: 14px;
            margin-bottom: 20px;
            font-weight: 300;
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;
            -webkit-transition-delay: 1.4s; /* Safari */
            transition-delay: 1.4s;
            opacity: 0;
            position: relative;
            left: -50px;
        }

        .cont_icon_like {
            position: relative;
            float: right;
            width: 70px;
            margin-top: 10px;
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;
            -webkit-transition-delay: 1.5s; /* Safari */
            transition-delay: 1.5s;
            opacity: 0;
            position: relative;
            left: -50px;
        }

        .cont_icon_like > p > i {
            color: #999;
            cursor: pointer;
        }

        .cont_icon_like > p > span {
            font-family: 'Open Sans';
            position: relative;
            top: -5px;
            left: 5px;
            color: #666;
        }

        .btn_read_m {
            position: relative;
            float: left;
            padding: 10px;
            border: none;
            background-color: #495FE9;
            color: #fff;
            margin: 10px 0;
            box-shadow: 1px 2px 10px 0px rgba(0, 0, 0, 0.3);
            font-size: 11px;
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;
            -webkit-transition-delay: 1.6s; /* Safari */
            transition-delay: 1.6s;
            opacity: 0;
            position: relative;
            left: -50px;

        }

        .cont_img_frond {

            position: relative;
            float: left;
            width: 35%;
            background: #eee;
            height: 100%;
            margin-right: 5%;
            overflow: hidden;
            top: 0;
        }

        .cont_img_frond_active {
            padding: 25px 0px;
            top: -25px;
            box-shadow: 1px 1px 20px 0px rgba(0, 0, 0, 0.3);
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;
        }

        .cont_img_frond > img {
            top: -25px;
            position: relative;
            left: -420px;
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;

        }

        .cont_img_back {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .cont_img_back > img {
            top: -25px;
            position: relative;
            -webkit-filter: grayscale(100%); /* Chrome, Safari, Opera */
            filter: grayscale(100%);
            opacity: 0.2;
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;


        }

        .img_2 {
            opacity: 0;
            display: none;

        }

        .img_d_n {
            display: none;
        }

        .img_d_b {
            display: block;
            -webkit-animation-name: escala_imagen; /* Chrome, Safari, Opera */
            -webkit-animation-duration: 10s; /* Chrome, Safari, Opera */
            animation-name: escala_imagen;
            animation-duration: 10s;
        }

        .cont_img_frond:hover > .cont_icons_img_from {
            bottom: 0px;
        }

        .cont_icons_img_from {
            position: absolute;
            bottom: -100px;
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;

            /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f24f5a+0,ffffff+78&1+0,0+78 */
            background: -moz-linear-gradient(bottom, rgba(242, 79, 90, 0.5) 0%, rgba(255, 255, 255, 0) 85%); /* FF3.6-15 */
            background: -webkit-linear-gradient(bottom, rgba(242, 79, 90, 0.5) 0%, rgba(255, 255, 255, 0) 85%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(bottom, rgba(242, 79, 90, 0.5) 0%, rgba(255, 255, 255, 0) 85%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f24f5a', endColorstr='#00ffffff', GradientType=0); /* IE6-9 */

            height: 70px;
            width: 100%;
        }

        .cont_icons_img_from > ul > li {
            position: relative;
            float: left;
            width: 33.33%;
        }

        .cont_icons_img_from > ul {
            margin-top: 20px;
        }

        .cont_icons_img_from > ul > li {
            list-style: none;
        }

        .cont_icons_img_from > ul > li > i {
            margin-left: 20px;
            text-align: center;
            font-size: 32px;
            color: #fff;
            cursor: pointer;
        }

        @-webkit-keyframes escala_imagen {
            from {
                -webkit-transform: scale(1);
                -moz-transform: scale(1);
                -ms-transform: scale(1);
                -o-transform: scale(1);
                transform: scale(1);

            }
            to {
                -webkit-transform: scale(1.5);
                -moz-transform: scale(1.5);
                -ms-transform: scale(1.5);
                -o-transform: scale(1.5);
                transform: scale(1.5);
            }
        }

        @-o-keyframes identifier {
            from {
                -webkit-transform: scale(1);
                -moz-transform: scale(1);
                -ms-transform: scale(1);
                -o-transform: scale(1);
                transform: scale(1);

            }
            to {
                -webkit-transform: scale(1.5);
                -moz-transform: scale(1.5);
                -ms-transform: scale(1.5);
                -o-transform: scale(1.5);
                transform: scale(1.5);
            }
        }

        @-moz-keyframes identifier {
            from {
                -webkit-transform: scale(1);
                -moz-transform: scale(1);
                -ms-transform: scale(1);
                -o-transform: scale(1);
                transform: scale(1);

            }
            to {
                -webkit-transform: scale(1.5);
                -moz-transform: scale(1.5);
                -ms-transform: scale(1.5);
                -o-transform: scale(1.5);
                transform: scale(1.5);
            }
        }

        @keyframes identifier {
            from {
                -webkit-transform: scale(1);
                -moz-transform: scale(1);
                -ms-transform: scale(1);
                -o-transform: scale(1);
                transform: scale(1);

            }
            to {
                -webkit-transform: scale(1.5);
                -moz-transform: scale(1.5);
                -ms-transform: scale(1.5);
                -o-transform: scale(1.5);
                transform: scale(1.5);
            }
        }

        html, body {
            height: 100vh;
        }

        #footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 50px;
            background-color: #e6e6e6;
        }

        #back {
            background: none !important;
            border: none;
            padding: 0 !important;
            /*optional*/
            font-family: arial, sans-serif;
            /*input has OS specific font-family*/
            cursor: pointer;
            font-size: 20px;

        }
    </style>

</head>
<body>

<script>


    var Cont = 0;

    function inic() {
        if (Cont % 2 != 0) {
            document.querySelector('.img_1').style.opacity = '0';
            document.querySelectorAll('.img_1')[1].style.opacity = '0';

            setTimeout(function () {
                document.querySelector('.img_1').className = 'img_1 img_d_n';
                document.querySelectorAll('.img_1')[1].className = 'img_1 img_d_n';

                document.querySelector('.img_2').className = 'img_2 img_d_b';

                document.querySelectorAll('.img_2')[1].className = 'img_2 img_d_b';

            }, 500);
            setTimeout(function () {
                document.querySelector('.img_2').style.opacity = '0.2';
                document.querySelectorAll('.img_2')[1].style.opacity = '1';

            }, 600);
            Cont++;
        } else {

            document.querySelector('.img_2').style.opacity = '0';
            document.querySelectorAll('.img_2')[1].style.opacity = '0';

            setTimeout(function () {

                document.querySelector('.img_2').className = 'img_2 img_d_n';
                document.querySelectorAll('.img_2')[1].className = 'img_2 img_d_n';

                document.querySelector('.img_1').className = 'img_1 img_d_b';
                document.querySelectorAll('.img_1')[1].className = 'img_1 img_d_b';

            }, 500);

            setTimeout(function () {
                document.querySelector('.img_1').style.opacity = '0.2';
                document.querySelectorAll('.img_1')[1].style.opacity = '1';
            }, 600);
            Cont++;
        }
    }

    window.onload = function () {
        inic();
        document.querySelector('.cont_text_img').className = "cont_text_img cont_text_img_act";
        setTimeout(function () {
            document.querySelector('.cont_img_frond').className = "cont_img_frond  cont_img_frond_active";
        }, 1700);


    }

    setInterval(function () {
        inic()
    }, 10000);
</script>

<div class="cont_principal">
    <div class="cont_text_img">
        <div class="cont_img_back">
            <img class='img_1' src="./img/<?php echo $provincia ?>.jpg" alt=""/>
            <img class='img_2' src="./img/<?php echo $provincia ?>.jpg" alt=""/></div>
        <div class="cont_text">
            <h1><?php echo $comune ?></h1>
            <p>
            <?php getInfo($comune, $connessione, $provincia, $regione); ?>
            </p>


            <button style="margin-top: -8px" class="btn_read_m"><a href="<?php echo getComune($comune) ?>"
                                          style="text-decoration: none; color: white">WIKIPEDIA</a></button>
            <div class="cont_icon_like" style="display: inline-flex; padding-top: 10px; padding-right: 15px; margin-top: -10px">
                <i class="fas fa-angle-double-left" style="line-height: 30px"></i> <span
                        style="padding-top: 2px; padding-left: 2px; margin-right: 5px">
                    <form action="home.php" method="get">
                        <?php
                        echo "<input type='hidden' name='regione' value='" . $regione . "'>";
                        echo "<input type='hidden' name='provincia' value='" . $provincia . "'>";
                        ?>
                        <input type="submit" value="indietro" name="indietro" id="back">
                    </form></span>
            </div>
        </div>
        <div class="cont_img_frond">
            <img class='img_1 img_d_b' src="./img/<?php echo $provincia ?>.jpg" alt=""/>
            <img class='img_2 img_d_n' src="./img/<?php echo $provincia ?>.jpg" alt=""/>
        </div>

    </div>


</div>

<footer id="footer">
    <center style="padding-top: 15px">
        Sito creato da Condello Alessandro per scopi didattici
    </center>
</footer>

</body>
</html>