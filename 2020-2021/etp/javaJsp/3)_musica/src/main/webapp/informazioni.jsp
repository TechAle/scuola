<!--
    File: informazioni.jsp

    Autore: Alessandro Condello
    Ultima modifica: 13/04/2021
-->
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%
    HttpSession sessions = request.getSession(false);
    String id = (String) sessions.getAttribute("id");
%>
<!DOCTYPE html>
<html lang="it">
<head>
    <!-- mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MusikBox - Informazioni</title>
    <!-- BootStrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Css della pagina -->
    <link rel="stylesheet" href="./css/main.css" >
    <style>
        /* background */
        html, body {
            background-image: url("./background/back.png");
            background-repeat: no-repeat;
            background-size: cover;
        }
        /* Il nostor form */
        #form {
            margin: 5% 5% 5% 5%;
            background-color: rgba(255, 255, 255, .45);
            height: 70%;
            overflow-y: scroll;
            padding-right: 10px;
        }

        /* Il titolo */
        #titolo {
            color: #2ffd33;
            text-align: center;
        }
        /* Footer */
        footer {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #292929;
        }
        /* Il testo dentro il footer */
        footer > div {
            color: white;
            text-align: center;
        }
        #contentIn {
            padding-left: 15px;
        }
        a {
            color: cyan;
        }
        a:hover {
            color: lightcyan;
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark position-absolute " id="nav">

    <div class="container" id="top">
        <a class="navbar-brand" id="logo" href="index.jsp">
            <img src="./logo/logo.png" alt="logo" id="logoSmall">        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.jsp">Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<%= id == null ? "login.jsp" : "logout.jsp" %>"><%= id == null ? "Login" : "Logout" %></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="informazioni.jsp">Informazioni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="negozio.jsp">Negozio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="crediti.jsp">Crediti</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="content">
    <div id="padding-header">
    </div>
    <!-- Il nostro content -->
    <div id="mainContent">
        <!-- il contenitore con le informazioni -->
        <div id="form">
            <h1 id="titolo">Informazioni</h1>
            <div id="contentIn">
                <ul>
                    <li>
                        Sito creato da condello alessandro per fini didattici per la scuola ITTG FAUSER NOVARA
                    </li>
                    <li>
                        Sito creato puramente a mano, con qualche informazioni/librerie prese online, controllare <a href="crediti.jsp">crediti</a> per maggiori informazioni
                    </li>
                    <li>
                        Per potere entrare come demo, username: DemoUsr password: demo
                    </li>
                    <li>
                        Il login demo serve affinche' voi possiate entrare con un account "demo" senza l'utilizzo di una password. Ho creato questa opzione affinche'<br>
                        chiunque possa entrare e testare il sito web anche se qualcuno abbia cambiato la password di demo<br>
                        Potete cambiare la password se e solo se voi state utilizzando un account demo.
                    </li>
                    <li>
                        Per contatti, contattere la seguente email: alessandro.condello@studenti.fauser.edu
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>


<footer>
    <div>
        Creato da condello alessandro per fini didattici
    </div>
</footer>

</body>
</html>