<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>pag</title>
</head>
<body>

<?php
$date = getdate();
printf("%s/%s/%s %s/%s", $date["wday"], $date["mon"], $date["year"], $date["minutes"], $date["hours"]);
?>
</body>
</html>
