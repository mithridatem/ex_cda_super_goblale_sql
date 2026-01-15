<?php
include 'env.php';

function sanitize(string $str): string
{
    //Supprimer les espaces devant
    $str = trim($str);
    //Supprimer les balises html
    $str = strip_tags($str);
    //supprimer des caractères
    $str = htmlspecialchars($str, ENT_NOQUOTES);
    return $str;
}

function connect_bdd(): PDO
{
    return new PDO('mysql:host='. DB_HOST . ';dbname='. DB_NAME. '',
    DB_USERNAME, 
    DB_PASSWORD,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}