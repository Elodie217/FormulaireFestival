<?php
session_start();

if (!isset($_SESSION['connectéUser'])) {
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
    <title>Page Admin</title>
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
        // instanciation de la classe Database
        $DBR = new Database('Reservation');
        $reservations = $DBR->getAllReservations();

        foreach ($reservations as $reservation) {
            $IdUser = $reservation->getIdUser();
            // instanciation de la classe User
            $DBU = new Database('User');
            $utilisateur = $DBU->getThisUtilisateurById($IdUser); ?>

            <div class="reservation <?= $reservation->getId() ?>">
                <div class="displaynomnum">
                    <p class="fontsize"><b><?= $utilisateur->getPrenom() ?> <?= $utilisateur->getNom() ?></b></p>
                    <p>Numéro de réservation : <?= $reservation->getId() ?></p>
                </div>


                <p>Nombre de réservation : <em><?= $reservation->getNbrReservation() ?></em></p>
                <p>Jour(s) choisi(s) :<em><?php if ($reservation->getTypeRerservation() == '1Journee0107') {
                                                echo ' le 01/07';
                                            } else if ($reservation->getTypeRerservation() == '1Journee0207') {
                                                echo ' le 02/07';
                                            } else if ($reservation->getTypeRerservation() == '1Journee0307') {
                                                echo ' le 03/07';
                                            } else if ($reservation->getTypeRerservation() == '2Journees01070207') {
                                                echo ' le 01/07 et le 02/07';
                                            } else if ($reservation->getTypeRerservation() == '2Journees02070307') {
                                                echo ' le 02/07 et le 03/07';
                                            } else if ($reservation->getTypeRerservation() == '3Journees') {
                                                echo ' les trois jours.';
                                            } else if ($reservation->getTypeRerservation() == '1JourneeReduit') {
                                                echo ' un jour en tarif réduit';
                                            } else if ($reservation->getTypeRerservation() == '2JourneesReduit') {
                                                echo ' deux jours en tarif réduit';
                                            } else if ($reservation->getTypeRerservation() == '3JourneesReduit') {
                                                echo ' trois jours en tarif réduit';
                                            } ?></em></p>
                <p>Nuit(s) : <em><?php
                                    $tableauNuitAdmin = str_split($reservation->getNuit());
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


                <?php if ($reservation->getNbrEnfant() == true) {
                ?>
                    <div class="displayflex">
                        <p>Enfant : <em>Oui</em></p>
                        <p class="casques">Casque(s) antibruit(s) : <em><?= $reservation->getNbrCasqueEnfant() ?></em></p>
                    </div>
                <?php } else {
                ?>
                    <div>
                        <p>Enfant : <em>Non</em></p>
                    </div>
                <?php }
                ?>
                <p>Descente(s) luge : <em><?= $reservation->getNbrDescenteLuge() ?></em></p>
                <p>Coordonnées : </p>
                <div class="displaycoordonnee">
                    <p>Email : <em><?= $utilisateur->getMail() ?></em></p>
                    <p>Téléphone : <em><?= $utilisateur->getTel() ?></em></p>
                    <p>Adresse : <em><?= $utilisateur->getAdresse() ?></em></p>
                </div>
                <p class="prixPaye fontsize"> Total :
                    <?= $reservation->calculerPrix() ?> €
                </p>


            </div>
        <?php }
        ?>
    </section>