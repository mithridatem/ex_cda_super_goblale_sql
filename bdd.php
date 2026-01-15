<?php
//import variable env
include 'env.php';

/**
 * Méthode pour se connecter à la BDD
 * @return PDO retourne un objet de connexion PDO
 */
function connect_bdd(): PDO
{
    return new PDO('mysql:host='. DB_HOST . ';dbname='. DB_NAME. '',
    DB_USERNAME, 
    DB_PASSWORD,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
