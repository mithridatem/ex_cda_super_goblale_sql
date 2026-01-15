<?php
//import des outils
include 'tools.php';

//Test si le formulaire est remplis
if (isset($_POST["submit"])) {
    //Test si les 4 champs sont remplis
    if (
        !empty($_POST["firstname"]) && 
        !empty($_POST["lastname"]) && 
        !empty($_POST["email"]) &&
        !empty($_POST["password"])) {
        //Nettoyer les entrées
        sanitize_array($_POST);
        //Hash du mot de passe
        $options = ['cost' => 12];
        $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT, $options);
        //Ajout en BDD
        $message = add_user($_POST);
    } else {
        $message = "Veuillez remplir les champs du formulaire";
    }
}

//Méthode pour ajouter un utilisateur en BDD
function add_user(array $user)
{
    try  {
        //1 se connecter à la BDD
        $bdd = connect_bdd();
        //2 Ecrire la requête SQL
        $sql = "INSERT INTO users(firstname, lastname, email,`password`) VALUE(?,?,?,?)";
        //3 Préparer la requête
        $req = $bdd->prepare($sql);
        //4 Assigner les 4 paramètres
        $req->bindValue(1, $user["firstname"], PDO::PARAM_STR);
        $req->bindValue(2, $user["lastname"], PDO::PARAM_STR);
        $req->bindValue(3, $user["email"], PDO::PARAM_STR);
        $req->bindValue(4, $user["password"], PDO::PARAM_STR);
        //5 Exécuter la requête
        $req->execute();
    } catch(Exception $e)
    {
        return "Le compte existe déja";
    }
    return "Le compte à été ajouté en BDD";
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>Ajouter un compte</title>
</head>
<body>
    
    <main class="container">
        <h1>Ajouter un compte</h1>
        <form action="" method="post">
            <fieldset>
                <input type="text" name="firstname" placeholder="Saisir votre prénom">
                <input type="text" name="lastname" placeholder="Saisir votre nom">
                <input type="email" name="email" placeholder="Saisir votre email">
                <input type="password" name="password" placeholder="Saisir votre mot de passe">
            </fieldset>
            <input type="submit" value="Ajouter" name="submit">
        </form>
        <p><?= $message ?? ""?></p>
    </main>
</body>
</html>