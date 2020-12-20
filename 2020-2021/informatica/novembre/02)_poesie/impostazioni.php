<?php
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
    $conf = json_decode($_COOKIE["settings_display"], true);
}else {$conf = $pred_config;}

if (isset($_POST["invia"])) {
    foreach ($conf as $key => $value) {
        $conf[$key] = $_POST[$key];
    }
    setcookie("settings_display", json_encode($conf), time()+3600);
    echo "Impostazioni aggiornate con successo.";
}
if (isset($_POST["reset"])) {
    setcookie("settings_display",json_encode($pred_config),time() + 3600);
    echo "Impostazioni resettate con successo.";
}
?>



