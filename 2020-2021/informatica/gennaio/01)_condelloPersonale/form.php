<?php
$conn = "";

include "connectionMain.php";
$conn->select_db("db_personale");
?>
<form action="./form.php" method="post">
    <label>Cognome: <input type="text" name="cognome"></label><br>
    <label>Nome: <input type="text" name="nome"></label><br>
    <label>CodFisc: <input type="text" name="codfisc"></label><br>
    <label>Assunto: <input type="date" name="assunto"></label><br>
    <label>Filiale: <input type="number" name="filiale"></label><br>
    <label>Funzione: <input type="text" name="funzione"></label><br>
    <label>Livello: <input type="number" name="livello"></label><br>
    <label>StipBase: <input type="text" pattern="[0-9,]" name="stipBase"></label><br>
    <label>Via: <input type="text" name="via"></label><br>
    <label>cap: <input type="text" name="cap"></label><br>
    <label>citta: <input type="text" name="citta"></label><br>
    <label>Prov: <input type="text" name="prov"></label><br>
    <input type="submit" value="invia" name="invia">
</form>
<?php
if (isset($_POST["invia"])) {
    $sqlCode= "INSERT INTO personale (cognome,nome,codFisc,Assunto,Filiale, Funzione, Livello, StipBase, Via, Cap, Citta, Prov) VALUES 
               ('".$_POST['cognome']."', '".$_POST['nome']."', '".$_POST['codfisc']."', DATE '".$_POST["assunto"]."', 
                '".$_POST["filiale"] ."', '".$_POST["funzione"]."', '".$_POST["livello"]."', '".$_POST["stipBase"]."',
                '".$_POST["via"]."', '".$_POST["cap"]."', '".$_POST["citta"]."', '".$_POST["prov"]."');";
    if ($conn->query($sqlCode) == true) {
        echo "Tutti i dati sono corretti e sono stati inseriti";
    }else echo "Dati errati";
}
?>