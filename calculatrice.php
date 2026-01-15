<?php
include 'tools.php';
    //test si le formulaire est submit
    if (isset($_POST["submit"])) {
        //Test si les 3 champs sont remplis
        if ($_POST["nbr1"] !="" && $_POST["nbr2"] !="" && !empty($_POST["operateur"]) ) {
            $message = calculatrice(
                sanitize($_POST["nbr1"]),
                sanitize($_POST["nbr2"]),
                sanitize($_POST["operateur"])
                );
        } else {
            $message = "Les champs ne sont pas tous remplis";
        }
    }

    function calculatrice(float|int $nbr1, float|int $nbr2, string $operateur): string
    {
        switch ($operateur) {
            case 'add':
                return $nbr1 . " + " . $nbr2 ." = " . ($nbr1+$nbr2); 
                break;
            case 'sous':
                return $nbr1 . " - " . $nbr2 ." = " . ($nbr1-$nbr2); 
                break;
            case 'multi':
                return $nbr1 . " x " . $nbr2 ." = " . ($nbr1*$nbr2); 
                break;
            case 'div':
                //Test si $nbr2 vaut zéro
                if ($nbr2 == 0) {
                    return "La division par zéro est impossible";
                }
                //sinon on fait la division
                return $nbr1 . " / " . $nbr2 ." = " . ($nbr1/$nbr2); 
                break;
            default:
                return "l'opération n'existe pas";
                break;
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
    <title>Calculatrice</title>
</head>

<body>
    <main class="container">
        <form action="" method="post">
            <fieldset>
                <input type="text" name="nbr1" placeholder="saisir un nombre">
                <input type="text" name="nbr2" placeholder="saisir un nombre" require>
                <input type="text" name="operateur" placeholder="add, sous, div, ou multi ..." require>
            </fieldset>
            <input type="submit" value="Calculer" name="submit">
        </form>
        <p><?= $message??"" ?></p>
    </main>
</body>

</html>