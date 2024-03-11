<?php
session_start();

if (isset($_SESSION['connecté'])) {
    header('location:pageUser.php');
    die;
} else if (isset($_SESSION['connectéAdmin'])) {
    header('location:pageAdmin.php');
    die;
}

require_once "./src/config.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/responsive.css">
</head>

<body>
    <!------------------- HEADER ------------------->
    <header class="header">
        <a href="./index.php" class="boutonConnexion">Formulaire</a>
        <h1>Vercors Musique Festival</h1>
    </header>
    <!------------------- BODY ------------------->
    <section class="connexion">
        <h2>Connexion</h2>

        <form action="./src/authentification.php" id="connexion" method="POST">
            <label for="emailConnexion">Email :</label>
            <input type="email" name="emailConnexion" id="emailConnexion">
            <label for="motDePasseConnexion">Mot de passe :</label>
            <input type="password" name="motDePasseConnexion" id="motDePasseConnexion">
            <input type="submit" class="bouton" value="Connexion">
            <?php
            if (!empty($_GET['erreur'])) {
                if ($_GET['erreur'] == 4) { ?>
                    <div class="messageechec">
                        Merci de remplir tous les champs.
                    </div>
                <?php } else if ($_GET['erreur'] == 6) { ?>
                    <div class="messageechec">
                        Le mail ou le mot de passe est incorrect.
                    </div>
                <?php
                } else if ($_GET['erreur'] == 7) { ?>
                    <div class="messageechec">
                        Le mail incorrect.
                    </div>
                <?php
                } else if ($_GET['erreur'] == 8) { ?>
                    <div class="messageechec">
                        MDP incorrect.
                    </div>
            <?php
                }
            } ?>

        </form>

    </section>

</body>

</html>