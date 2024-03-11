<?php
session_start();
require_once "./config.php";
require_once "./classes/User.php";
require_once "./classes/Database.php";

$Database = new Database("User");

$mailAdmin = htmlspecialchars("admin@admin.com");
$motDePasseAdmin = password_hash("Jesuisadmin", PASSWORD_DEFAULT);
// Personne possédant un compte


if (isset($_POST['emailConnexion']) && isset($_POST['motDePasseConnexion']) && !empty($_POST['emailConnexion']) && !empty($_POST['motDePasseConnexion'])) {
    if (filter_var($_POST['emailConnexion'], FILTER_VALIDATE_EMAIL)) {
        $mail = htmlspecialchars($_POST['emailConnexion']);
        $_SESSION['mailSession'] = $mail;
        //Si la personne possède les identifiants admin
        if ($mail === $mailAdmin) {
            if (password_verify($_POST['motDePasseConnexion'], $motDePasseAdmin)) {
                $_SESSION['connectéUser'] = TRUE;
                //Renvoie à la page Admin quand tout est bon
                header('location:../pageAdmin.php');
                die;
            } else {
                
                header('location:../connexion.php?erreur=' . ERREUR_CONNEXION);
            }
        }
        $userMailConnexion = $Database->getThisUtilisateurByEmail($mail);
        if ($userMailConnexion) {
           

            if ($userMailConnexion !==  $mailAdmin) {
                if (password_verify($_POST['motDePasseConnexion'], $userMailConnexion->getPassword())) {
                    $_SESSION['connecté'] = TRUE;
                    header('location:../pageUser.php');
                }
            } else {
               
                header('location:../connexion.php?erreur=' . ERREUR_CONNEXION);
            }
        } else {
           header('location:../connexion.php?erreur=' . ERREUR_CONNEXION);
        }
    } else {
       
        header('location:../connexion.php?erreur=' . ERREUR_CHAMP_VIDE);
    }
}
