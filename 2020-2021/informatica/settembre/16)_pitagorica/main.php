<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>pag</title>
</head>
<body>
<table border="1" cellpadding="5">
<?php

for($i = 1; $i <= 10; $i++) {
    echo ("<tr>");
    for($j = 1; $j <= 10; $j++) {
        echo "<td>" . $i * $j . '</td>';
    }
    echo '<br></tr>';
}

?></table>
</body>
</html>
