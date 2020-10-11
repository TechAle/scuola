<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>pag</title>
</head>
<body>
<form action="" method="post">
    <label>
        <div>A: </div>
        <input type="text" name="a"/>
    </label> <!-- A -->

    <label>
        <div>B: </div>
        <input type="text" name="b"/>
    </label> <!-- B -->

    <label>
        <div>C: </div>
        <input type="text" name="c"/>
    </label> <!-- C -->

    <div>
        <input type="submit" name="invia">
        <input type="reset" name="azzera">
    </div> <!-- invio + reset -->
</form>

<?php
$output = "";
if (isset($_POST["invia"])) {
    $a = $_POST["a"];
    $b = $_POST["b"];
    $c = $_POST["c"];

    $delta = $b**2 - 4 * $a * $c;
    
    if ( $delta < 0 )
        $output = "Nessuna soluzione valida";
    elseif ($delta == 0)
        $output = "1 soluzione: " . (-$b / (2*$a));
    else
        $output = "2 soluzioni: " . ((-$b + sqrt($delta)) / (2*$a)) . " " . ((-$b - sqrt($delta)) / (2*$a));
    
}

?>
<?php echo $output; ?>
</body>
</html
