
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- MetaData -->
    <link rel="shortcut icon" type="image/x-icon" href="./img/logo.svg">
    <!-- Better mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Belle Foto srl - Crediti</title>
    <!-- BootStrap -->
    <link rel="stylesheet" href="./dependences/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="./dependences/jquery.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- BootStrap things again -->
    <script src="./dependences/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="./dependences/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Page Css -->
    <link rel="stylesheet" href="./css/main.css" >
    <style>


        /* Html Body normal css */
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            scroll-behavior: smooth;
            height: 100vh;
            background-image: url("./img/background.png");
            background-repeat: no-repeat;
            background-size: cover;
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
            min-height: 76px;
        }

        /* Main Content CSS */
        #mainContent {
            background-color: transparent;
            flex-grow: 1;
            z-index: 1;
            left:0;
            top:0;
            right:0;
            bottom:0;
            width:calc(100% - 100px);
            box-sizing: border-box;
            height:auto;
            margin-bottom:50px;
            margin-top:50px;
            margin-left: 50px;
            margin-right: 50px;
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
        #contenitoreForm {
            height: 100%;
            max-width: 600px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 50px 1fr;
            grid-template-rows: 1fr;
            gap: 0px 0px;

        }
        #divForm {
            background-color: white;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            border-bottom-left-radius: 20px;

        }
        #bottoni {
            writing-mode: vertical-rl;
            display: flex;
            visibility: hidden;
        }
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
                    <a class="nav-link" href="#">Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="crediti.php">Crediti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="FAQ.php">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="terms.php">Terms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacts.php">Contacts</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="content">
    <!-- Since we have an header that is absolute, we have to simulate his height, and we'll do this is a padding  -->
    <div id="padding-header">
    </div>
    <!-- Main Content -->
    <div id="mainContent">

        <style>
            .Titolo {
                text-align: center;
                padding-top: 10px;
                font-size: 75px;
                margin-bottom: 0;
            }


            .regReg {
                overflow-y: scroll;
            }

        </style>



        <div id="contenitoreForm">
            <div id="bottoni">
                <div id="loginScelta" class="scelte" >Login</div>
                <div id="registrazioneScelta" class="scelte">Registrazione</div>
            </div>
            <div id="divForm">
                <div class="regReg">
                    <h1 class="Titolo">Crediti</h1>
                    <ul class="list-group">
                        <li class="list-group-item">Sito creato da Condello Alessandro per scopi didattici</li>
                        <li class="list-group-item">Utilizzata la libreria bootstrap per rendere il sito mobile friendly</li>
                        <li class="list-group-item">Icone di fontawesome</li>
                    </ul>
                </div>
            </div>


        </div>

    </div>
</div>




</body>
</html>