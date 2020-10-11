<?php
    $stringa = "abaccce";
    $vocali = array('a', 'e', 'i', 'o', 'u');
    foreach ($vocali as $vocale) {
        echo $vocale . " : " . preg_match_all("/[$vocale]/i", $stringa) . "<br>";
    }

    foreach ($vocali as $vocale) {
        echo $vocale . " : " . substr_count($stringa, $vocale) . "<br>";
    }
