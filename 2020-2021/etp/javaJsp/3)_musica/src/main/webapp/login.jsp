<!--
    File: login.jsp

    Autore: Alessandro Condello
    Ultima modifica: 13/04/2021
-->
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%
    HttpSession sessions = request.getSession(false);
    String id = (String) sessions.getAttribute("id");
    if (id != null) {
        response.sendRedirect("errore.jsp?errore=login0");
    }
%>
<!DOCTYPE html>
<html lang="it">
<head>
    <link rel="icon" href="logo/logo.png">
    <!-- mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MusikBox - Login</title>
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
        }
        /* Il nostor form */
        #form {
            margin: 5% 5% 5% 5%;
            background-color: rgba(255, 255, 255, .45);
            height: 70%;
        }

        form {
            padding: 2% 2% 2% 2%;
        }
        /* Il titolo */
        #titolo {
            color: #2ffd33;
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
                    <a class="nav-link" href="login.jsp">Home
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="login.jsp">Login</a>
                </li>
                <li class="nav-item">
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
        <!-- Il form -->
        <div style="text-align: center" id="form">
            <h1 id="titolo">Login</h1>
            <form method="post" action="login">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" aria-describedby="nome">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" aria-describedby="password">
                </div>
                <button type="submit" class="btn btn-primary" name="login">Login</button>
                <button type="submit" class="btn btn-primary" name="demoLogin">Demo Login</button>
                <!-- Bottone per le informazioni -->
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" style="padding: 3px 6px 3px 6px">
                    <i class="fas fa-question-circle"></i>
                </button>
            </form>
        </div>

    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Username: DemoUsr<br>
                Password: demo<br>
                Se per qualunque motivo vi dice che la password è errata (siccome qualcuno l'ha cambiata),<br>
                usate il bottone "demo login" per potere accedere senza password (funziona solamente se l'username appartiene ad un account demo)
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
</script>


<footer>
    <div>
        Creato da condello alessandro per fini didattici
    </div>
</footer>

</body>
</html>