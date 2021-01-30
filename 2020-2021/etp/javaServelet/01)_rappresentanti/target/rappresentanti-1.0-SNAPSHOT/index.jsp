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

<div  class="bg-light" style="margin-bottom: 20px">
    <center>
        <div class="navbar-brand mb-0 h1" style="color: #1fddff; ">Rappresentanti</div>
    </center>
    <div class="navbar-brand mb-0 h5" style="color: #1fddff; padding-left: 10px">Scegliere chi si vuole visualizzare</div>
</div>

<form action="classe" method="get">
    <div class="row" style="text-align: center; width: 100%">

        <div class="col col-12 col-md-6"><label for="5AI">5AI</label><input type="radio" id="5AI" name="classe" value="5AI"></div>
        <div class="col col-12 col-md-6"><label for="5AC">5AC</label><input type="radio" id="5AC" name="classe" value="5AC"></div>
        <div class="col col-12 col-md-6"><label for="5BI">5BI</label><input type="radio" id="5BI" name="classe" value="5BI"></div>
        <div class="col col-12 col-md-6"><label for="5BC">5BC</label><input type="radio" id="5BC" name="classe" value="5BC"></div>
        <div class="col col-12"><button type="submit" class="btn btn-outline-primary">invia</button></div>
    </div>
</form>


<div class="row" style="text-align: center; width: 100%">
    <div class="col col-12 col-md-6" id="valutaci"><a>Valutaci!</a></div>
    <div class="col col-12 col-md-6"><a href="classe?classe=5bi">Contatta la 5bi!</a></div>
</div>
<form action="classe" method="post" style="margin-top: 15px; visibility: hidden" id="votazione">
    <div class="row" style="text-align: center">
    <div  class="col col-12 col-md-6">
    <button type="submit" class="btn btn-success" name="si" value="mi piace">si</button>
    </div>
    <div  class="col col-12 col-md-6">
        <button type="submit" class="btn btn-danger" name="no" value="non mi piace">no</button>
    </div>
    </div>
</form>



<footer class="bg-light text-center text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2020 Copyright: Fauser
    </div>
    <!-- Copyright -->
</footer>

<script>
    window.addEventListener('click', function(e){
        if (document.getElementById('valutaci').contains(e.target)){
            document.getElementById("votazione").style.visibility = "visible";
        } else{
        }
    })
</script>

</body>
</html>