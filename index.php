<?php

include 'vendor/autoload.php';

session_start();

$_SESSION["etat"] = "connecté";
$_SESSION["prenom"] = "Mathieu";
$_SESSION["annee"] = 2026;
$_SESSION["state"] = true;

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="session.php">connecté</a>
    <a href="deconnexion.php">donnecté</a>
</body>
</html>
