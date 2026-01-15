<?php
include 'bdd.php';

//Méthode pour ajouter un utilisateur en BDD
function add_user(array $user): string
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

//Méthode pour mettre à jour un utilisateur en BDD
function update_user(array $user): string
{
    try {
        //1 Se connecter à la BDD
        $bdd = connect_bdd();
        //2 Ecrire la requête SQL
        $sql = "UPDATE users SET firstname = ?, lastname = ?, email = ?, `password` = ? WHERE email = ?";
        //3 Préparer la requête SQL
        $req = $bdd->prepare($sql);
        //4 Assigner les paramètres
        $req->bindValue(1, $user["firstname"], PDO::PARAM_STR);
        $req->bindValue(2, $user["lastname"], PDO::PARAM_STR);
        $req->bindValue(3, $user["email"], PDO::PARAM_STR);
        $req->bindValue(4, $user["password"], PDO::PARAM_STR);
        $req->bindValue(5, $user["old_email"], PDO::PARAM_STR);
        //5 Exécuter la requête SQL
        $req->execute();
    } catch (PDOException $e) {
        return "Mise à jour impossible";
    }
    return "Le compte a été mis à jour";
}

//Méthode pour vérifier si un compte existe depuis sont email
function is_user_exists_by_email(string $email): bool
{
    try {
        //1 Se connecter à la BDD
        $bdd = connect_bdd();
        //2 Ecrire la requête SQL
        $sql = "SELECT u.id FROM users AS u WHERE u.email = ?";
        //3 Préparer la requête SQL
        $req = $bdd->prepare($sql);
        //4 Assigner les paramètres
        $req->bindParam(1, $email, PDO::PARAM_STR);
        //5 Exécuter la requête SQL
        $req->execute();
        //Récupérer les données
        $user = $req->fetch(PDO::FETCH_ASSOC);
        //Test si le compte n'existe pas
        if (empty($user)) return false;
    }
    catch (PDOException $e) {
        return false;
    }
    return true;
}
