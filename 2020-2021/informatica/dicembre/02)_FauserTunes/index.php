<?php
$autore = "";
$canzone = "";
$immagine = "grigio.png";
if (isset($_GET["autore"]))
{
    $autore = $_GET["autore"];
    if(isset($_GET["canzone"])) {
        $canzone = $_GET["canzone"];
    }
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Music Player - Day 009</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css'><link rel="stylesheet" href="./style.css">

    <link rel="stylesheet" href="my_css.css">
    <script src="my_script.js"></script>
</head>
<body>
<?php
echo "<script>var autore = '";
echo $autore;
echo "'</script>"
?>
<div class="table">
  <div class="table-cell">
        <div id="player">
        <div id="main">
            <img id="immagine_id" style="height: 240px; width: 390px; margin-top: 5px; margin-left: 5px" src="copertine/<?php echo $immagine?>">
          <div>
            <div class="playback_controls">
              <h3 id="artist"><?php echo $autore?> - <?php echo $canzone ?></h3>
              <div class="time-holder">
                <div class="slider">
                  <div class="fill"></div>
                </div>
              </div>
              <div>
              <i class="fa fa-bars menu"></i>
              <div class="buttons">
                <i class="fa fa-backward" id="back"></i>
                <i class="fa fa-play loading" id="playpause"></i>
                <i class="fa fa-forward" id="next"></i>
              </div>
            </div>
            </div>
            <audio id="playbar" controls></audio>
          </div>
        </div>
        <ol id="playlist">
            <?php

            if ($autore != "") {
                $album = scandir("artisti/" . $autore );
                for ($i = 0; $i < count($album); $i++) {
                    if ($album[$i][0] != '.') {
                        $f = fopen("artisti/" . $autore . "/" . $album[$i], 'r');
                        while (($linea = fgets($f)) !== false) {
                            $parti = explode(";", $linea);
                            $tipo = "track";
                            if (!strcmp(str_replace(" ", "_", $parti[0]), $canzone)) {
                                $tipo = "playing";
                                $prima = explode(".", $album[$i]);
                                $immagine = $prima[0] . ".jpg";
                                echo '<script>
                                    document.getElementById("immagine_id").src = "./copertine/'.$immagine . '"
                                     </script>';

                            }
                            echo '<li class="'.$tipo.'"><a class="track" onclick="musica_scelta(this)">'. $parti[0] .'</a> <span class="time" onclick="porta_link(this)">'. $parti[1].'</span></li>';
                        }
                        fclose($f);
                    }
                }
            }

            ?>
        </ol>
        <div style="height: 100px; overflow-y: scroll; overflow-x: hidden; background-color: white">
            <?php
            $artisti = scandir("artisti/");
            for ($i = 0; $i < count($artisti); $i++) {
                $artista = str_replace("_", " ", $artisti[$i]);
                echo "<ul>";
                if ($artista[0] != '.') {
                    echo "<li class='autori_text'><a href='index.php?autore=". $artista ."'>" . str_replace("_", " ", $artisti[$i]) . '</a></li><hr class="autori">';
                }
                echo "</ul>";
            }
            ?>
        </div>
  </div>
  </div>
</div>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js'></script><script  src="./script.js"></script>

</body>
</html>
