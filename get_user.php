<?php
include 'tools.php';
include 'user.php';

//tester si le formulaire est submit
if (isset($_POST["submit"])) {
    //tester si le champs email est renseigné
    if (!empty($_POST["email"])) {
        //nettoyer le champ (sanitize)
        $email = sanitize($_POST["email"]);
        //Récupérer l'utilisateur
        $message = get_user_by_email($email);
        //Test si le compte existe
        if (gettype($message) == "array") {
            //formater en chaine de caractères
            $message = "id: " . $message["id"] . " prénom: " . 
            $message["firstname"] . " nom: " .  
            $message["lastname"] . " email: " . 
            $message["email"];
        }
        //Sinon le compte n'existe pas
        else {
            $message = "Le compte n'existe pas";
        }
    } 
    //Sinon le champ est vide
    else {
        $message = "Veuillez remplir le champ email";
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>chercher un utilisateur</title>
</head>

<body>
    <main class="container">
        <h1>Chercher un compte utilisateur</h1>
        <form action="" method="post">
            <fieldset>
                <input type="email" name="email" placeholder="saisir le mail">
            </fieldset>
            <input type="submit" value="Rechercher" name="submit">
        </form>
        <p><?= $message ?? "" ?> </p>
    </main>

</body>

</html>