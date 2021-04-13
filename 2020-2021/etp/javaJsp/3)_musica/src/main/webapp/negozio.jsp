<!--
    File: negozio.jsp

    Autore: Alessandro Condello
    Ultima modifica: 13/04/2021
-->
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%@ page import="edu.fauser.DbUtility" %>
<%@ page import="java.sql.*" %>
<%@ page import="java.util.ArrayList" %>
<%@ page import="com.example.musica.Brano" %>
<%@ page import="com.example.musica.Carrello" %>
<%@ page import="com.example.musica.CarrelloGestore" %>
<%
    HttpSession sessions = request.getSession(false);
    String id = (String) sessions.getAttribute("id");
    if (id == null) {
        response.sendRedirect("errore.jsp?errore=logout0");
    }
    HttpSession sessione = request.getSession();
    Carrello c = CarrelloGestore.getCarrello(sessione);
%>
<!DOCTYPE html>
<html lang="it">
<head>
    <link rel="icon" href="logo/logo.png">
    <!-- mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MusikBox - Negozio</title>
    <!-- BootStrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Icons -->
    <script src="https://kit.fontawesome.com/5ec4217b43.js" crossorigin="anonymous"></script>
    <!-- Css della pagina -->
    <link rel="stylesheet" href="./css/main.css" >
    <style>
        /* background */
        html, body {
            background-image: url("./background/back.png");
            background-repeat: no-repeat;
            background-size: cover;
            overflow-y: hidden;
        }
        /* Il nostor form */
        #form {
            margin: 5% 5% 5% 5%;
            background-color: rgba(255, 255, 255, .45);
            height: 70%;
            min-height: 70vh;
            z-index: 1;
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
        /* Content dentro */
        #contentIn {
            height: 75%;
            max-height: 75%;
            min-height: 75%;
            overflow-y: scroll;
            overflow-x: hidden;
            margin-right: 15px;
            margin-left: 15px;
            padding-top: 10px;
            border: darkslategray solid;
            border-width: 2px;
            padding-left: 10px;
            padding-right: 10px;
        }
        /* Links */
        a {
            color: cyan;
        }
        a:hover {
            color: lightcyan;
        }
        /* Dimensioni del content  */
        #content {
            max-height: 50%;
            min-height: 50%;
        }
        #padding-header {
            min-height: 81px;
        }
        #mainContent {
            max-height: 100vh;
        }
        /* Button */
        button {
            margin-top: 10px;
        }
        /* Riga per la musica */
        .musicaSelect {
            width: 100%;
            background-color: lightgray;
            min-height: 110px;
            border: black solid;
            border-width: 2px;
        }
        .musicaSelect > div > div > img {
            padding-top: 7px !important;
            padding-left: 10px !important;
            position: relative;

        }
        /* Pictures */
        .icon {
            font-size: 60px;
            padding-top: 20px;
            float: left;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 15px;
            color: black;
            -webkit-text-fill-color: transparent;
            text-fill-color: transparent;
            -webkit-text-stroke: 2px black;
            text-stroke: 2px black;
            background: transparent;
            transition: -webkit-text-stroke .4s linear;
        }

        .icon:hover,
        .icon:active,
        .icon:focus {
            -webkit-text-stroke: 2px #40934d;
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
                    <a class="nav-link" href="logout.jsp">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="informazioni.jsp">Informazioni</a>
                </li>
                <li class="nav-item active">
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
        <!-- Form -->
        <div id="form">
            <!-- titolo -->
            <h1 id="titolo">Informazioni</h1>
            <!-- Content effettivo -->
            <div id="contentIn">
                <%
                    // Prendiamo tutti i nostri brani
                    /*
                    Per rendere il tutto più facilmente leggibile per noi programmatori, ho deciso di
                    fare la lettura qua, per poi dopo con un ciclo for scrivere
                     */
                    DbUtility dbu = DbUtility.getInstance(application);
                    ArrayList<Brano> brani = new ArrayList<>();

                    try (Connection cn = DriverManager.getConnection(dbu.getUrl(), dbu.getUser(), dbu.getPassword())) {
                        // Sql per la lettura
                        String strSql = "select codice, titolo, nomeCantante, durata, prezzo from brani;";

                        try (Statement stm = cn.createStatement()) {
                            // Iteriamo per ogni risultato
                            ResultSet rs = stm.executeQuery(strSql);
                            while (rs.next()) {
                                brani.add(new Brano(rs.getInt(1), rs.getString(2), rs.getString(3), rs.getInt(4), rs.getFloat(5)));
                            }
                        }catch (java.sql.SQLException e) {
                            e.printStackTrace();
                        }
                    }
                %>

                <script>
                    // List
                    const list = {
                        <%
                        /*
                        Devo fare un dizionario con numero -> canzone
                        questo determinerà la canzone che verrà suonata data una determinata musica
                         */
                        int i = 0;
                        for(Brano br : brani) {
                            %><%=i++%> : "<%=br.getTitolo()%>", <%

                        }
                        %>
                    }
                    // Audio
                    var audio;
                    // Funzione per avviare nuove musiche
                    function playMusic(value) {
                        // Se abbiamo avviato qualcosa prima
                        if (audio !== undefined)
                            audio.pause()
                        // Nuovo audio
                        audio = new Audio('./anteprime/'+list[value]+'.mp3');
                        audio.play();
                    }
                </script>

                <!-- Selezionare musiche -->
                <%
                    i = 0;
                    for(Brano br : brani) {
                        // Se l'abbiamo già comprato, saltalo
                        if (c.contains(br.getCodice())) {
                            i++;
                            continue;
                        }
                        %>
                <div class="musicaSelect">
                    <!-- Varie righe -->
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <img src="img/<%=br.getTitolo()%>.png" alt="sunnyside.png" width="100px" height="100px" align="left">
                            <span><%= br.getTitolo()%><br>
                                Creato da <%= br.getNomeCantante()%><br>
                                Prezzo <%= br.getPrezzo()%>
                            </span>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <i class="fas fa-play icon" onclick="playMusic(<%=i++%>)"></i>
                            <i class="fas fa-shopping-cart icon" onclick="window.location = 'CarrelloGestore?codice=<%=br.getCodice()%>&Azione=Aggiungi'"></i>
                        </div>
                    </div>
                </div><%


                }
                %>

            </div>
            <!-- Carrello -->
            <center>
                <button onclick="window.location ='carrello.jsp'" class="btn btn-dark" style="margin-top: 5px !important;">Carrello</button>
            </center>
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