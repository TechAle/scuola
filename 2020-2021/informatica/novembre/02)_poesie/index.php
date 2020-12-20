<?php
    // Importo delle varie librerie
    include 'impostazioni.php';


function Debug_to_Console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>
<html lang="it">
<head>

    <meta charset="UTF-8">

    <title>Poesie</title>

    <!-- https://codepen.io/robinselmer/pen/roaWpK -->
    <!--suppress CssUnresolvedCustomProperty -->
    <style>

        /* Variabili */
        :root {

        <?php
        $a = 0;
        $pred_config = array(
                    // Carta
                    "--bcn-card" => "#fff",
                    "--bg-color" => "#e5e5e5",
                    "--linea-carta" => "#e6eaee",
                    "--bordo-card" => "#e6eaee",
                    // DashBoard
                    "--text-color-h1" => "#fff",
                    "--bcn-orange" => "#f16a2d",
                    // Header
                    "--header-background" => "#fff",
                    "--header-text" => "#000",
                    "--shadow-header" => "rgba(136, 136, 136, 0.16)",
                    // Menu
                    "--bcn-orange-light" => "#f9ae56",
                    "--bcn-menu" => "#313541",
                    "--bcn-text-titolo" => "#76808f",
                    "--bcn-text-linea" => "#76808f",
                    "--bcn-text-corpo" => "#76808f",
                    // Bottone
                    "--btn-testo" => "#fff",
                    "--bcn-btn" => "#56bf89",
                    // Fotter
                    "--bc-footer" => "#1d2127"
            );
            if (isset($_COOKIE["settings_display"])) {
                $conf = json_decode($_COOKIE["settings_display"], true); $a = 2;
            }else {$conf = $pred_config; $a = 1;}
            foreach ($conf as $key => $value) {
                echo $key . ": " . $value . ';';
            }
        ?>

        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            height: 100%;
            overflow-x: hidden;
            margin: 0;
        }

        .admin {
            --spacing: 1rem;
            display: -webkit-box;
            flex-wrap: wrap;
            display: grid;
            grid-template-rows: 80px 1fr 80px;
            grid-template-columns: 300px 1fr;
            grid-template-areas: "header header" "nav    main" "footer footer";
        }
        .admin__header {
            display: -webkit-box;
            display: flex;
            flex-basis: 100%;
            grid-area: header;
            height: 80px;
            background-color: var(--header-background);
            box-shadow: 0 3px 6px var(--shadow-header);
            position: relative;
        }
        .admin__nav {
            -webkit-box-flex: 0;
            flex: 0 0 300px;
            grid-area: nav;
            background-color: var(--bcn-menu);
            overflow: scroll;
            height: 100%;
        }
        ::-webkit-scrollbar {
            width: 0px;
            background: transparent; /* make scrollbar transparent */
        }
        .admin__main {
            -webkit-box-flex: 1;
            flex: 1;
            grid-area: main;
            padding: var(--spacing);
            overflow-y: auto;
            overflow-x: hidden;
            -webkit-overflow-scrolling: touch;
            background-color: var(--bg-color);
        }
        .admin__footer {
            display: -webkit-box;
            display: flex;
            grid-area: footer;
            flex-basis: 100%;
            -webkit-box-pack: justify;
            justify-content: space-between;
            -webkit-box-align: center;
            align-items: center;
            height: 80px;
            padding: 0 var(--spacing);
            background-color: var(--bc-footer);
        }

        /* Lo spazio fra il grigio e il bianco. Quando lo schermo è piccolo è 1rem, quando grande 2rem */
        @media screen and (min-width: 48rem) {
            .admin {
                --spacing: 2rem;
            }
        }

        a {
            text-decoration: none;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .logo {
            display: -webkit-box;
            display: flex;
            -webkit-box-flex: 0;
            flex: 0 0 300px;
            height: 80px;
            -webkit-box-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            align-items: center;
            position: relative;
            margin: 0;
            color: var(--text-color-h1);
            background-color: var(--bcn-orange);
            font-size: 1rem;
        }

        .toolbar {
            display: -webkit-box;
            display: flex;
            -webkit-box-flex: 1;
            flex: 1;
            -webkit-box-pack: justify;
            justify-content: space-between;
            -webkit-box-align: center;
            align-items: center;
            padding: 0 var(--spacing);
            color: var(--header-text);
        }

        .menu {
            list-style-type: none;
            padding: 0;
        }
        .menu__title {
            display: block;
            padding: 2rem 2rem .5rem;
            color: var(--bcn-text-titolo);
            font-weight: 700;
        }
        .menu__divider::before {
            content: "";
            display: block;
            width: calc(100% - 60px);
            height: 2px;
            margin: 0 20px 5px;
            background-color: var(--bcn-text-linea);
        }
        .menu__link {
            display: block;
            padding: 10px 30px;
            color: var(--bcn-text-corpo);
            text-decoration: none;
        }

        .menu__link:hover, .menu__link:focus {
            color: currentcolor;
            background-color: var(--bcn-orange-light);
        }

        .card {
            height: 100%;
            font-weight: 300;
            background-color: var(--bcn-card);
            border: 1px solid var(--bordo-card);
            -webkit-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .card__header {
            padding: 20px 30px;
            border-bottom: 1px solid var(--linea-carta);
            font-weight: 700;
        }
        .card__item {
            padding: 20px 30px;
            height: 80%;
            overflow: auto;
        }

        .btn {
            display: inline-block;
            border-radius: 5em;
            border: 0;
            padding: 10px 30px;
            white-space: nowrap;
            height: 50px;
        }
        .btn--primary {
            color: var(--btn-testo);
            background-color: var(--bcn-btn);
        }
        .display_bottone_sinistr0 {
            font-size: 20px;
        }

    </style>

</head>
<body class="admin">
    <header class="admin__header">
        <a href="#" class="logo">
            <h1>Poesie</h1>
        </a>
        <div class="toolbar">
            Testo delle poesie
        </div>
    </header>
    <nav class="admin__nav">
        <ul class="menu">
            <!--
            <li class="menu__title">Leopardi</li>
            <li class="menu__divider"></li>
            <li class="menu__item">
                <a class="menu__link" href="#">L'infinito</a>
            </li>
            <li class="menu__item">
                <a class="menu__link" href="#">Il sabato del villaggio</a>
            </li>-->
            <?php
            $handle = fopen("elenco_poesie.txt", "r");
            $poesie = array();
            $autori = array();
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    // process the line read.
                    $values = explode(" ", $line);
                    $prova = $values[0];
                    array_push($poesie, $values[0]);
                    array_push($autori, substr((strtolower(strip_tags($values[1]))), 0, -1));
                }

                fclose($handle);
            }
            // Andiamo alla licerca di autore in autore
            $autori_fatti = array();
            // output che andrà al javascript
            $output_js = "{";
            $fatti = 0;
            // Iteriamo per tutti gli autori
            for($i = 0; $i < count($autori); $i++) {
                if (!in_array($autori[$i], $autori_fatti)) {
                    array_push($autori_fatti, $autori[$i]);
                    // Scriviamo l'autore
                    echo '<li class="menu__title">'. $autori[$i] . '</li><li class="menu__divider"></li>';
                    // Iteriamo per tutte le poesie
                    for($j = 0; $j < count($poesie); $j++) {
                        if (strcmp($autori[$i], $autori[$j]) == 0) {
                            echo '<li class="menu__item" onclick="aggiorna_poesia(\''.$poesie[$j] . ' ' . $autori[$i] . '\')"><a class="menu__link" href="#">'. str_replace("_", " ", $poesie[$j]) .'</a></li>';
                            if ($fatti != 0)
                                $output_js .= ',';
                            $fatti += 1;
                            $output_js .= '"' . $poesie[$j] . '" : "';
                            $myfile = fopen("./poesie/" . $poesie[$j] . ".txt", "r");
                            $output_js .= str_replace("\n", "", fread($myfile,filesize("./poesie/" . $poesie[$j] . ".txt")));
                            fclose($myfile);
                            $output_js .= '"';
                        }
                    }

                }

            }
            $output_js .= '}';
            echo "<script>var poesie = ". $output_js .";</script>";
            ?>
        </ul>
    </nav>

    <script>
        function aggiorna_poesia(nome) {
            document.getElementById("titolo_carta").innerText = nome.split(" ")[1];
            document.getElementById("corpo_carta").innerText = poesie[nome.split(" ")[0]];
        }
    </script>

    <main class="admin__main">
       <div class="card">
            <div class="card__header" id="titolo_carta">
                Tutorial
            </div>
            <div class="card__content">
                <div class="card__item" id="corpo_carta">
                    A sinistra puoi selezionare  le poesie che poi verranno visualizzate qui <br>
                    In basso a sinistra, puoi modificare il layout di tutta la pagina <br>
                    In basso a destra puoi aggiungere delle poesie. Solo persone autenticate possono.
                </div>
            </div>
        </div>
    </main>
    <?php

    function create_form_display($conf)
    {
        $output = "";
        foreach ($conf as $key => $value) {
            $output .= sprintf("<label> %s : <input type=\"text\" name=\"%s\" value=\"%s\"></label><br>", $key, $key, $value);
        }
        return "'$output'";
    }
    ?>
    <footer class="admin__footer">
        <div class="toolbar">
            <div class="toolbar__left">
                <button onclick="modifica_display()" class="btn btn--primary display_bottone_sinistr0">Modifica Display</button>
            </div>
            <div class="toolbar__right">
                <a href="./carica.php" class="btn btn--primary logout">Aggiungi Poesie</a>
            </div>
        </div>
    </footer>

    <script>
        function modifica_display() {

            document.getElementById("titolo_carta").innerText = "Display";
            document.getElementById("corpo_carta").innerHTML = "<form method='post' action='./impostazioni.php'>" + <?php echo create_form_display($conf) ?> + "<input type=\"submit\" name=\"invia\" value=\"invia\"><input type=\"submit\" name=\"reset\" value=\"reset\"></form>"

        }
    </script>

</body>
</html>