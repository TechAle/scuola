<?php

    function esegui_query($query,$connessione)
    {
    echo "Eseguo query: <pre><code class=\"language-sql\">$query</code></pre>";
    $ris = $connessione->query($query);
    if ($ris == false) 
        {
        echo "<p style='color: red;'>Errore della query: " . htmlspecialchars($connessione->error) . ".</p>";
        }
    else
        {   
        echo "<p style='color: darkseagreen;'>Query eseguita correttamente.</p>";   
        }
    }


function ritorna_array($query,$connessione)
    {
    $ris = $connessione->query($query);
    if ($ris == false) 
        {
        $rit=-1;
        }
    else
        {  
        $numRighe = $ris->num_rows;
        if ($numRighe > 0) 
            {
            while($row = $ris->fetch_row()) 
                {
                $rit[]=$row[0];  
                }
            }
        else 
            $rit=0;
        } 
    return $rit;
    }

 //carica i dati in una tabella da file CSV    
function carica_csv($tabella,$connessione,$file_csv,$id,$visualizza)
    {
    $query="select DISTINCT COLUMN_NAME from information_schema.COLUMNS where TABLE_NAME=\"".$tabella."\"";
    //echo $query;
    $campi=ritorna_array($query,$connessione);
    //print_r($campi);
    if($id==TRUE)
        array_shift($campi);
    $campi = implode(",", $campi);
    $inserisci="INSERT INTO $tabella ($campi) VALUES";
    $nt=0;
    $ni=0;
    $CSVfp = fopen($file_csv, "r");
    if($CSVfp !== FALSE) 
        {
        while(!feof($CSVfp)) 
            {
            $data = fgetcsv($CSVfp, 1000, ";");
            if(is_array($data))
            {
            //print_r($data);
            $n = count($data); 
            $valori="";
            for ($i=0; $i < $n; $i++)
                if($i!=0)
                    $valori.=",'".$connessione->real_escape_string($data[$i])."'";
            else
                $valori.="'".$connessione->real_escape_string($data[$i])."'";
            $query=$inserisci." (".$valori.");";
            $nt++;
            if($visualizza==TRUE)
                echo "Eseguo query: <pre><code class=\"language-sql\">$query</code></pre>";
            $ris =$connessione->query($query);
            if ($ris == false) 
                {
                echo "<p style='color: red;'>Errore della query: " . htmlspecialchars($connessione->error) . ".</p>";
                }
            else
                {
                $ni++;
                }
            }
        }
        }
    fclose($CSVfp);
    if($nt==$ni)
        echo "<p style='color: darkseagreen;'>Tutte le righe ($ni su $nt) sono stato correttamente caricate nella  tabella \"$tabella\".</p>";
    else
        echo "<p style='color: red;'>Sono state caricate nella tabella \"$tabella\" $ni record su $nt righe presenti nel file \"$file_csv\" </p>";
    $rit = array("Letti"=>$nt, "Inseriti"=>$ni);
    return $rit;
    }


function svuota_tabella($tabella,$connessione)
    {
    $nrec=0;
    $query="DELETE FROM ".$tabella;
    echo "Eseguo query: <pre><code class=\"language-sql\">$query</code></pre>";
    $ris = $connessione->query($query);
    if ($ris == false) 
        {
        echo "<p style='color: red;'>Errore della query: " . htmlspecialchars($connessione->error) . ".</p>";
        }
    else
        {
        $nrec=$connessione->affected_rows;
        echo "<p style='color: darkseagreen;'>Sono stati cancellati $nrec record.</p>";
        }
    return $nrec;
    }


function visualizza_tabella($query,$connessione,$visualizzaQuery)
    {
    if($visualizzaQuery==TRUE)
        echo "Eseguo query: <pre><code class=\"language-sql\">$query</code></pre>";
    $ris = $connessione->query($query);
    if ($ris == false) 
        {
        echo "<p style='color: red;'>Errore della query: " . htmlspecialchars($connessione->error) . ".</p>";
        }
    else
        {   
        $numRighe = $ris->num_rows;
        if ($numRighe > 0) 
            {
            echo "<table border=\"1\" class=\"table table-striped table-bordered table-hover\">";
            $campi=$ris->fetch_fields();
            echo "<thead> <tr>";
            foreach ($campi as $col)
                {
                echo "<th scope=\"col\">$col->name</th>";
            }
            echo "</tr></thead><tbody>";
            while($row = $ris->fetch_row()) 
                {
                echo "<tr>";
                for ($i=0;$i<$ris->field_count;$i++)
                    {
                    echo "<td>".$row[$i]."</td>";
                    }
                echo "</tr>";
                }
            echo "</tbody></table>";   
            }
        else 
            echo "<h4 style='color: darkseagreen;'>La query non ha restituito risultati.</h4>";
        }
    }



?>