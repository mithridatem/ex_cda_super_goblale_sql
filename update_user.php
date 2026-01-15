<?php
include 'tools.php';
include 'user.php';

//test si le formulaire est submit
if (isset($_POST["submit"])) {
    //Tests si les champs sont remplis
    if (
        !empty($_POST["firstname"]) &&
        !empty($_POST["lastname"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["password"]) &&
        !empty($_POST["old_email"])
    ) {
        //Nettoyage des entrées utilisateurs
        sanitize_array($_POST);
        //Test si le compte existe
        if (is_user_exists_by_email($_POST["old_email"])) {
            
            //Test si le nouveau email n'existe pas déja utilisé avec un enregistrement
            if (!is_user_exists_by_email($_POST["email"])) {
                //Hash du mot de passe
                $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
                //Mise à jour du compte utilisateur
                $message = update_user($_POST);
            } else {
                $message = "Le mail est déja utilisé";
            }
        } 
        //Test sinon le compte n'existe pas
        else {
            $message = "Le compte n'existe pas";
        }
    } 
    //Sinon les champs sont vides
    else {
        $message ="Veuillez remplir tous les champs";
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
    <title>Mettre à jour un utilisateur</title>
</head>

<body>
    <main class="container-fluid">
        <h1>Mettre à jour les informations du compte</h1>
        <form action="" method="post">
            <fieldset>
                <input type="email" name="old_email" placeholder="Saisir l'ancien email">
                <input type="text" name="firstname" placeholder="Saisir le prénom">
                <input type="text" name="lastname" placeholder="Saisir le nom">
                <input type="email" name="email" placeholder="Saisir le mail">
                <input type="password" name="password" placeholder="Saisir le mot de passe">
                <input type="submit" value="Modifier" name="submit">
            </fieldset>
        </form>
        <p><?= $message ?? "" ?></p>
    </main>
</body>

</html>