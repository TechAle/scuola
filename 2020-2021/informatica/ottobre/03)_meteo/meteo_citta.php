<html lang="it">
    <head>

        <title><?php
            $citta = $_GET["citta"];
            echo $citta;

            $f=fopen("meteo.txt","r") or die ("Errore apertura file auto.txt...");
            $output = "";
            while($s=fgets($f)) {
                $v = explode(";", $s);
                if ($v[0] == $citta) {
                    $meteo_mattina = $v[1];
                    $gradi_mattina = $v[2];
                    $meteo_pomeriggio = $v[3];
                    $gradi_pomeriggio = $v[4];
                    $meteo_sera = $v[5];
                    $gradi_sera = $v[6];
                }
            }

            ?></title></head>

    <style>
        table, th, td, thead {
            border: 1px solid black;
        }
    </style>

    <body>

    <table>
        <th COLSPAN="3"><?php echo $citta;?></th>
        <tr>
            <th>MATTINA</th>
            <th><?php echo sprintf("<img src='./%s.jpg'/>", $meteo_mattina);  ?>
            </th>
            <th><?php echo $gradi_mattina  ?></th>
        </tr>
        <tr>
            <th>POMERIGGIO</th>
            <th><?php echo sprintf("<img src='./%s.jpg'/>", $meteo_pomeriggio);  ?>
            </th>
            <th><?php echo $gradi_pomeriggio  ?></th>
        </tr>
        <tr>
            <th>SERA</th>
            <th><?php echo sprintf("<img src='./%s.jpg'/>", $meteo_sera);  ?>
            </th>
            <th><?php echo $gradi_sera  ?></th>
        </tr>
    </table>

    </body>
</html>