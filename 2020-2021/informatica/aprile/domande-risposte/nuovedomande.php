<!DOCTYPE HTML>
<html>
<?php require "./inc/head.php"?>
<body>
<?php require "./inc/header-index.php" ?>
<div id="colorlib-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 animate-box">
                <h2>Nuova domanda</h2>
                <form action="domandaServlet.php" method="post">
                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="text" maxlength="100" id="domanda" name="domanda" class="form-control"
                                   placeholder="Testo della domanda" required>
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