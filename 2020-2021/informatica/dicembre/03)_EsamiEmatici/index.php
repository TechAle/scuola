<?php
$elencoesami = array();
$f = fopen("esami_ematici.txt", 'r') or die("errore apertura esami ematici");
while(! feof($f))
{
    $values = explode("|", fgets($f));
    $elencoesami[$values[0]] = array(intval($values[1]), intval($values[2]));
}
fclose($f);
$codiciFiscali = array();
$files = scandir("./esami/");
foreach ($files as $value) {
    if ($value[0] != '.') {
        $div = explode(".", $value);
        array_push($codiciFiscali, $div[0]);
    }
}

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Dashboard</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<span class="bckg"></span>
<header>
  <h1>Dashboard</h1>
  <nav>
    <ul>
      <li>
        <a href="javascript:void(0);" data-title="Progetti">Progetti</a>
      </li>
      <li>
        <a href="javascript:void(0);" data-title="Esami">Esami</a>
      </li>
      <li>
        <a href="javascript:void(0);" data-title="Agenda">Agenda</a>
      </li>
      <li>
        <a href="javascript:void(0);" data-title="Assistenza">Assistenza</a>
      </li>
    </ul>
  </nav>
</header>
<main>
  <div class="title">
    <h2>Projects</h2>
    <a href="javascript:void(0);">Hello Bob !</a>
  </div>

  <article class="larg">
      <?php
      foreach ($codiciFiscali as $codice) {
          echo "<div><h3>".$codice."<span class='entypo-down-open'></span></h3>";
          echo "<p>";
          $f = fopen("./esami/" . $codice . ".txt", 'r');
          while(! feof($f))
          {
              $values = explode("|", fgets($f));
              $valore1 = intval($values[1]);
              echo $values[0] . " " . $values[1];
              echo ($valore1 < $elencoesami[$values[0]][0])
                  ? "*" : '';
              echo ($valore1 > $elencoesami[$values[0]][1])
                  ? "*" . $elencoesami[$values[0]] : '';
              echo "<br>";
          }
          fclose($f);
          echo "</p></div>";
      }
      ?>
  </article>
</main>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./script.js"></script>

</body>
</html>
