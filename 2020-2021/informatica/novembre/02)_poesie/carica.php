<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carica</title>
    <style>
        label {
            display: block;
            margin: 5px 5px 5px 5px;
        }
        fieldset {
            width: 200px;
        }
    </style>
</head>
<body>
    <center>
    <fieldset>
        <form method="post" action="carica_upload.php" enctype="multipart/form-data">
            <label>
                Autore : <input type="text" name="titolo">
            </label>
            <label>
                Testo : <input type="file" name="file">
            </label>
            <?php
                if (!isset($_SESSION['isLogged']) | $_SESSION['isLogged']==0) {
                    echo '<label>
                Utente: <input type="text" name="username">
            </label>
            <label>
                Password: <input type="text" name="password">
            </label>';
                } else {
                    echo '<input type="submit" name="logout" value="logout">';
                }
            ?>

            <input style="align-content: center" type="submit" name="avvia">
        </form>
    </fieldset>
    </center>

</body>
</html>