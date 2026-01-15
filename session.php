<?php

session_start();

if (isset($_SESSION["etat"])) {
    echo $_SESSION["etat"] . "<br>";
    echo $_SESSION["prenom"]  . "<br>";
    echo $_SESSION["annee"]  . "<br>";
}
else {
    echo "déconnecté";
}
