<?php
$db_host = "";
$db_user = "";
$db_pass = "";
$db_name = "";
include "parametri.php";
$conn = new mysqli($db_host,$db_user,$db_pass, $db_name) or die("Errore connessione server");
$ris = $conn->query("SELECT codice, domanda, risposta, nickname FROM dr_domande");
function getImage($codice) {
    $db_host = "";
    $db_user = "";
    $db_pass = "";
    $db_name = "";
    include "parametri.php";
    $conn = new mysqli($db_host,$db_user,$db_pass, $db_name) or die("Errore connessione server");
    $sql = "SELECT img, tipo FROM dr_domande WHERE codice = " . $conn->real_escape_string($codice);

    $ris = $conn->query($sql);

    if (!$ris ) {
        return "";
    } else {
        $row = mysqli_fetch_array($ris);
        header("Content-type: " . $row["imageType"]);
        echo $row["imageData"];
    }
}
?>
<!DOCTYPE HTML>
<html lang="it">
    <?php require "./inc/head.php"?>
<body>
    <?php require "./inc/header-index.php" ?>

    <div class="colorlib-blog" id="elenco">
        <div class="container">
            <div class="row">
                <?php
                $conta = 0;
                while ($row = $ris->fetch_row()) {
                    $conta++;
                    if ($conta > 1 && ($conta % 3) == 1)
                        echo "</div><div class='row'>";
                    echo '<div class="col-md-4 animate-box" >
                                <article>';

                    if ($row[2] == null) {
                        echo '<p style="height: 5em;">
                                    <a href="nuovarisp.jsp?codice='.$row[0].'">Rispondi</a>
                                </p>
                                <p style="height: 2.5em;" class="author-wrap">&nbsp;</p>';
                    } else {
                        echo 'p style="height: 5em;"><%= AppUtility.escapeHTML(rs.getString("risposta")) %></p>
                                <p style="height: 2.5em;" class="author-wrap">
                                    <span class="author-img" style="background-image: url(data:image/jpeg;base64,'.getImage($row[0]).');"></span>
                                    <span class="author">Autore: '.$conn->real_escape_string($row[3]).'</span></p>';
                    }

                    echo '      </article>
                          </div>';
                }

                ?>
            </div>
        </div>

    </div>

    <?php require "./inc/header-index.php" ?>
</body>

</html>
