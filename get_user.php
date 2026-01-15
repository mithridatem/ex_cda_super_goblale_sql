<?php
include 'tools.php';

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

//Méthode pour chercher un users en BDD par son email
function get_user_by_email(string $email): array|bool
{
    try {
        //1 Se connecter à la BDD
        $bdd = connect_bdd();
        //2 Ecrire la requête
        $sql = "SELECT u.id, u.firstname, u.lastname, u.email FROM users AS u WHERE u.email = ?";
        //3 Préparer la requête
        $req = $bdd->prepare($sql);
        //4 Assigner le paramètre
        $req->bindParam(1, $email, PDO::PARAM_STR);
        //5 Exécuter la requête
        $req->execute();
        //6 retourner le resultat de la requête (tab association)
        $user = $req->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $user = false;
    }
    return $user;
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