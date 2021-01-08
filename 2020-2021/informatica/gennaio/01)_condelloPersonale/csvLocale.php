<?php
$conn = "";

include "connectionMain.php";
$conn->select_db("db_personale");
$file = fopen("personale.csv","r");
$i = 0;
$j = 0;
while(! feof($file))
{
    $tutto = fgets($file);
    $diviso = explode(";", $tutto);
    $dataDiv = explode("-", $diviso[3]);
    $data = $dataDiv[2] . '-' . $dataDiv[1] . '-' . $dataDiv[0];
    $sqlCode= "INSERT INTO personale (cognome,nome,codFisc,Assunto,Filiale, Funzione, Livello, StipBase, Cap, Via, Citta, Prov) VALUES 
               ('".$diviso[0]."', '".$diviso[1]."', '".$diviso[2]."', DATE '".$data."', '".$diviso[4]."', '".$diviso[5]."', '".$diviso[6]."', '".$diviso[7]."', '".$diviso[8]."', '"."$diviso[9]"."', '".$diviso[10]."', '".$diviso[11]."')";
    if($conn->query($sqlCode) == false) {
        $i++;
        echo $diviso[9] . "<br>";
    }
    else
        $j++;
}
echo "Dati non inseriti per via di un erroe: " . $i . "<br>";
echo "Dati inseriti correttamente: " . $j;