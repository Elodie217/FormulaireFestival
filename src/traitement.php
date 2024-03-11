<?php

// importer ici les classes nécéssaires
require_once "./classes/User.php";
require_once "./classes/Database.php";
require_once "./classes/Reservation.php";

require_once "./config.php";


// vérification champs formulaire et récupération des données

if (isset($_POST['nombrePlaces']) && isset($_POST['nom']) && isset($_POST['prenom'])  && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['adressePostale']) && isset($_POST['password']) && isset($_POST['passwordBis'])  && !empty($_POST['nombrePlaces']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['telephone']) && !empty($_POST['adressePostale']) && !empty($_POST['password']) && !empty($_POST['passwordBis'])) {

     // deux instanciations de la classe Database : user et reservation
    $databaseUser = new Database("User");
    $databaseReservation = new Database("Reservation");

    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $mail = htmlspecialchars($_POST['email']);
    } else {
        header('location:../index.php?erreur=' . ERREUR_EMAIL);
    }

    $tel = htmlspecialchars($_POST['telephone']);
    $adresse = htmlspecialchars($_POST['adressePostale']);


    if ($_POST["password"] == $_POST["passwordBis"]) {
        $mdp = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $mdpBis = password_hash($_POST["passwordBis"], PASSWORD_DEFAULT);
    } else {
        header('location:../index.php?erreur=' . ERREUR_PASSWORD_IDENTIQUE);
    }




    $user = new User($nom, $prenom, $mail, $tel, $adresse, $mdp);

    $retourUser = $databaseUser->saveUtilisateur($user);


    if (isset($_POST['choixJour1'])) {
        $typeRerservation = '1Journee0107';
    } else if (isset($_POST['choixJour2'])) {
        $typeRerservation = '1Journee0207';
    } else if (isset($_POST['choixJour3'])) {
        $typeRerservation = '1Journee0307';
    } else if (isset($_POST['choixJour12'])) {
        $typeRerservation = '2Journees01070207';
    } else if (isset($_POST['choixJour23'])) {
        $typeRerservation = '2Journees02070307';
    } else if (isset($_POST['pass3jours'])) {
        $typeRerservation = '3Journees';
    } else if (isset($_POST['pass1jourreduit'])) {
        $typeRerservation = '1JourneeReduit';
    } else if (isset($_POST['pass2joursreduit'])) {
        $typeRerservation = '2JourneesReduit';
    } else if (isset($_POST['pass3joursreduit'])) {
        $typeRerservation = '3JourneesReduit';
    }

    // Création d'un tableau avec la méthode POST pour récupérer le type de nuit choisis
    $nbrReservation = htmlspecialchars($_POST['nombrePlaces']);
    $nuit = "";
    if (isset($_POST['tenteNuit1'])) {
        $nuit .= 'a';
    }
    if (isset($_POST['tenteNuit2'])) {
        $nuit .= 'b';
    }
    if (isset($_POST['tenteNuit3'])) {
        $nuit .= 'c';
    }
    if (isset($_POST['tente3Nuits'])) {
        $nuit .= 'd';
    }
    if (isset($_POST['vanNuit1'])) {
        $nuit .= 'e';
    }
    if (isset($_POST['vanNuit2'])) {
        $nuit .= 'f';
    }
    if (isset($_POST['vanNuit3'])) {
        $nuit .= 'g';
    }
    if (isset($_POST['van3Nuits'])) {
        $nuit .= 'h';
    }



    if (isset($_POST['enfantsOui'])) {
        $nbrEnfant = TRUE;
    } else {
        $nbrEnfant = FALSE;
    }

    if (isset($_POST['nombreCasquesEnfants']) && !empty($_POST['nombreCasquesEnfants'])) {
        $nbrCasqueEnfant = $_POST['nombreCasquesEnfants'];
    } else {
        $nbrCasqueEnfant = 0;
    };

    if (isset($_POST['NombreLugesEte']) && !empty($_POST['NombreLugesEte'])) {
        $nbrDescenteLuge = $_POST['NombreLugesEte'];
    } else {
        $nbrDescenteLuge = 0;
    };

    // création de la variable $iderUser qui récupère l'id des utilisateurs pour la stocker dans le csv des réservations
    $idUser = $user->getId();

    // instanciation de la classe Réservation
    $reservation = new Reservation($nbrReservation, $typeRerservation, $nuit, $nbrEnfant, $nbrCasqueEnfant, $nbrDescenteLuge, $idUser);
    $retourReservation = $databaseReservation->saveReservation($reservation);



    if ($retourUser) {
        include "../includes/popUp.php";
        die;
    } else {
        header('location:../index.php?erreur=' . ERREUR_ENREGISTREMENT);
        die;
    }
} else {

    header('location:../index.php?erreur=' . ERREUR_CHAMP_VIDE);
}
