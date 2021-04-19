<?php
$db_host = "";
$db_user = "";
$db_pass = "";
$db_name = "";
include "parametri.php";
$conn = new mysqli($db_host,$db_user,$db_pass, $db_name) or die("Errore connessione server");
$testo = null;
$codice = -1;
try {
    $codice = intval($_GET["codice"]);
} catch (\http\Exception\BadConversionException $e) {
    echo $e->getTraceAsString();
    return;
}

$sql = "SELECT domanda FROM dr_domande WHERE codice = " . $conn->real_escape_string($codice);
$ris = $conn->query($sql);

if ($row = $ris->fetch_row()) {
    $testo = $row[0];
} else {
    echo "Codice non trovato";
    return;
}
?>
<!DOCTYPE HTML>
<html lang="it">
<?php require "./inc/head.php"?>
    <body>
    <?php require "./inc/header-index.php" ?>
    <div id="colorlib-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 animate-box">
                    <h2>Nuova risposta</h2>
                    <form action="RispostaServlet.php" method="post" enctype = "multipart/form-data">
                        <input type="hidden" name="codice" value="<%= codice %>" />
                        <div class="row form-group">
                            <div class="col-md-12">
                                <div>Domanda: <strong><?php $conn->real_escape_string($testo) ?></strong></div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="text" maxlength="100" id="risposta" name="risposta" class="form-control"
                                       placeholder="Testo della risposta" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <input type="text" maxlength="100" id="nickname" name="nickname" class="form-control"
                                       placeholder="Nickname" required>
                            </div>
                            <label for="img" class="col-md-3 col-form-label">Immagine (max. 10 kB)</label>
                            <div class="col-md-5">
                                <input type = "file" name = "img" id="img" size = "50" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Invia" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require "./inc/header-index.php" ?>
    </body>
</html>
