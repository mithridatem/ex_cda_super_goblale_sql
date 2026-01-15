<?php

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

function sanitize_array(array &$data): void 
{
    foreach ($data as $key => $value) {
        //Test si la colonne n'est pas un tableau
        if (gettype($value) != 'array')
        {
            $data[$key] =  sanitize($value);
        } 
    }
}
