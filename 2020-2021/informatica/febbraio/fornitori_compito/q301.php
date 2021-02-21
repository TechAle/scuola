<!DOCTYPE html>
<html lang="it">
<head>
<title>Ricerca per cognome</title>
<meta charset="UTF-8"/>
      <link rel="stylesheet" href="rsc/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="rsc/css/stili.css"/>
      <style type="text/css">
          body {
              padding-top: 5vh;
          }
      </style>
      <link rel="stylesheet" href="prism.css"/>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>

function CercaCognome(str) 
  {
  $.ajax(
      {
      type:'POST',
      url:'q301a.php',
      data: $("#mioForm").serialize(),
      success: function(data)
        {
          $('#esito').html(data);
        }
      });
  return false;
  }
</script>
</head>
<body>
<main role="main" class="container">
<div class="testoQuery" >
Ricerca per cognome
</div>
<br>
<form  id="mioForm" method='POST'>
<div class="form-group">
    <label for="Cognome">Cognome</label>
    <input type="text" name="Cognome" class="form-control" id="Cognome" maxlength="20" onkeyup="CercaCognome(this.value)">
  </div>
<br>
</form>
<div id="esito"><b>Cerca per cognome.....</b></div>
<p><a href="index.php"><-- Ritorna alla pagina principale</a></p>
</main>
<script type="text/javascript" src="prism.js"></script>
</body>
</html>