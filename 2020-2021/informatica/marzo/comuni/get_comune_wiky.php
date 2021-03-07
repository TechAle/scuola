<?php

function getComune($getValue) {
    return "https://it.wikipedia.org/wiki/" . str_replace(' ', '_', ucwords($getValue));
}
function getInfo($comune, $conn, $provincia, $regione) {

    $query = '  select istat, superficie, num_residenti 
                from citta 
                where comune like "'.$comune.'" ';
    $ris = $conn->query($query) or die("Errore esecuzione " . $query);
    $values = $ris->fetch_row();
    $istat = $values[0];
    echo sprintf("Provincia: %s<br>Regione: %s<br>Superficie: %s<br>Residenti: %s<br>", $provincia, $regione, $values[1], $values[2]);
    $query = 'select abitanti, patrono_nome, patrono_data from info where istat like "'.$istat.'" ';
    $ris = $conn->query($query) or die("Errore esecuzione " . $query);
    $values = $ris->fetch_row();
    echo sprintf("Nome abitanti: %s<br>Patrono Nome: %s<br>", $values[0], $values[1]);
    if ($values[2] != "") {
        echo "Patrono Data: " . $values[2] . "<br>";
    }

    $query = 'select lng, lat from geo where istat like "'.$istat.'"';
    $ris = $conn->query($query) or die("Errore esecuzione " . $query);
    $values = $ris->fetch_row();

    echo sprintf('<br><iframe 
                  width="300" 
                  height="100" 
                  frameborder="0" 
                  scrolling="yes" 
                  marginheight="0" 
                  marginwidth="0" 
                  src="https://maps.google.com/maps?q='.$values[1].','.$values[0].'&hl=it&z=14&amp;output=embed"
                 >
                 </iframe>
');

}