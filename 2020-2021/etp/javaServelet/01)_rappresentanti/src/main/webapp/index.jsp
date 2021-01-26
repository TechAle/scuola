<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<!DOCTYPE html>
<html lang="en" style="height: 100vh">
<head>
    <meta charset="UTF-8">
    <title>Fauser</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <style>
        label {
            padding: 0px 1px 0px 8px;
        }

        input[type=radio],
        input.radio {
            margin: 2px 0 0 2px;
        }
        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

    </style>
</head>
<body style="height: 100%">

<nav class="navbar navbar-light bg-dark">
    <span class="navbar-brand mb-0 h1" style="color: #ffc11f">Indietro</span>
    <span class="navbar-brand mb-0 h1" style="color: #ffc11f">Fauser</span>
</nav>

<div class="bg-light" style="margin-bottom: 20px">
    <center>
        <div class="navbar-brand mb-0 h1" style="color: #1fddff; ">Rappresentanti</div>
    </center>
    <div class="navbar-brand mb-0 h5" style="color: #1fddff; padding-left: 10px">Scegliere chi si vuole visualizzare</div>
</div>

<form action="classe" method="get">
    <div class="row" style="text-align: center; width: 100%">

        <div class="col col-12 col-md-6"><label for="5AIN">5AIN</label><input type="radio" id="5AIN" name="classe" value="5AIN"></div>
        <div class="col col-12 col-md-6"><label for="5AC">5AC</label><input type="radio" id="5AC" name="classe" value="5AC"></div>
        <div class="col col-12 col-md-6"><label for="5BIN">5BIN</label><input type="radio" id="5BIN" name="classe" value="5BIN"></div>
        <div class="col col-12 col-md-6"><label for="5BC">5BC</label><input type="radio" id="5BC" name="classe" value="5BC"></div>
        <div class="col col-12"><button type="submit" class="btn btn-outline-primary">invia</button></div>
    </div>
</form>


<div class="row" style="text-align: center; width: 100%">
    <div class="col col-12 col-md-6">Valutaci!</div>
    <div class="col col-12 col-md-6">Contatta la 5bin!</div>
</div>



<footer class="bg-light text-center text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2020 Copyright: Fauser
    </div>
    <!-- Copyright -->
</footer>

</body>
</html>