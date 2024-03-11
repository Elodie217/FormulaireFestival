<?php
session_start();

if (!isset($_SESSION['connecté'])) {
    header('location: connexion.php');
    die;
}

require_once "src/classes/Reservation.php";
require_once "src/classes/User.php";
require_once "src/classes/Database.php";


?>

<!DOCTYPE html>
<html lang="fr">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page utilisateur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/responsive.css">

</head>

<body>

    <!------------------- HEADER ------------------->
    <header class="header">
        <a href="./deconnexion.php" class="boutonConnexion">Déconnexion</a>
        <h1>Vercors Musique Festival</h1>
    </header>
    <!------------------- BODY ------------------->

    <section>
        <?php
        $DBU = new Database('User');
        $User =  $DBU->getThisUtilisateurByEmail($_SESSION['mailSession']);

        $IdUser = $User->getId();

        $DBR = new Database('Reservation');
        $reservationUser = $DBR->getThisReservationById($IdUser);


        ?>

        <div class="reservation <?= $reservationUser->getId() ?>">
            <div class="displaynomnum">
                <p class="fontsize"><b><?= $User->getPrenom() ?> <?= $User->getNom() ?></b></p>
                <p>Numéro de réservation : <?= $reservationUser->getId() ?></p>
            </div>


            <p>Nombre de réservation : <em><?= $reservationUser->getNbrReservation() ?></em></p>
            <p>Jour(s) choisi(s) :<em><?php if ($reservationUser->getTypeRerservation() == '1Journee0107') {
                                            echo ' le 01/07';
                                        } else if ($reservationUser->getTypeRerservation() == '1Journee0207') {
                                            echo ' le 02/07';
                                        } else if ($reservationUser->getTypeRerservation() == '1Journee0307') {
                                            echo ' le 03/07';
                                        } else if ($reservationUser->getTypeRerservation() == '2Journees01070207') {
                                            echo ' le 01/07 et le 02/07';
                                        } else if ($reservationUser->getTypeRerservation() == '2Journees02070307') {
                                            echo ' le 02/07 et le 03/07';
                                        } else if ($reservationUser->getTypeRerservation() == '3Journees') {
                                            echo ' les trois jours.';
                                        } else if ($reservationUser->getTypeRerservation() == '1JourneeReduit') {
                                            echo ' un jour en tarif réduit';
                                        } else if ($reservationUser->getTypeRerservation() == '2JourneesReduit') {
                                            echo ' deux jours en tarif réduit';
                                        } else if ($reservationUser->getTypeRerservation() == '3JourneesReduit') {
                                            echo ' trois jours en tarif réduit';
                                        } ?></em></p>
            <p>Nuit(s) : <em><?php
                                $tableauNuitAdmin = str_split($reservationUser->getNuit());
                                foreach ($tableauNuitAdmin as $indiceTableauNuit) {
                                    if ($indiceTableauNuit == 'a') {
                                        echo ' la nuit en tente du 01/07 <br>';
                                    } else if ($indiceTableauNuit == 'b') {
                                        echo ' la nuit en tente du 02/07 <br>';
                                    } else if ($indiceTableauNuit == 'c') {
                                        echo ' la nuit en tente du 03/07 <br>';
                                    } else if ($indiceTableauNuit == 'd') {
                                        echo ' les trois nuits en tente <br>';
                                    } else if ($indiceTableauNuit == 'e') {
                                        echo ' la nuit en van du 01/07 <br>';
                                    } else if ($indiceTableauNuit == 'f') {
                                        echo ' la nuit en van du 02/07 <br>';
                                    } else if ($indiceTableauNuit == 'g') {
                                        echo ' la nuit en van du 03/07 <br>';
                                    } else if ($indiceTableauNuit == 'h') {
                                        echo ' les trois nuits en van <br>';
                                    };
                                } ?></em></p>


            <?php if ($reservationUser->getNbrEnfant() == true) {
            ?>
                <div class="displayflex">
                    <p>Enfant : <em>Oui</em></p>
                    <p class="casques">Casque(s) antibruit(s) : <em><?= $reservationUser->getNbrCasqueEnfant() ?></em></p>
                </div>
            <?php } else {
            ?>
                <div>
                    <p>Enfant : <em>Non</em></p>
                </div>
            <?php }
            ?>
            <p>Descente(s) luge : <em><?= $reservationUser->getNbrDescenteLuge() ?></em></p>
            <p>Coordonnées : </p>
            <div class="displaycoordonnee">
                <p>Email : <em><?= $User->getMail() ?></em></p>
                <p>Téléphone : <em><?= $User->getTel() ?></em></p>
                <p>Adresse : <em><?= $User->getAdresse() ?></em></p>
            </div>
            <p class="prixPaye fontsize"> Total :
                <?= $reservationUser->calculerPrix() ?> €
            </p>


        </div>

    </section>