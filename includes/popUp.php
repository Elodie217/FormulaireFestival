<?php


?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif commande</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="./assets/responsive.css">

</head>

<body>


    <header class="header">
        <a href="../connexion.php" class="boutonConnexion">Connexion</a>
        <h1>Résumé de votre commande</h1>
    </header>

    <div class="blocFormulaire">
        <ul>
            <!-- $typeRerservation, $nuit, $nbrEnfant, $nbrCasqueEnfant, $nbrDescenteLuge, $idUser -->
            <p><?= $nom ?> <?= $prenom ?></p>



            <li><?= "Vous avez pris " . $nbrReservation . " réservations." ?></li>
            <li> <?php if ($typeRerservation == '1Journee0107') {
                        echo 'Vous avez réservé pour le 01/07';
                    } else if ($typeRerservation == '1Journee0207') {
                        echo 'Vous avez réservé pour le 02/07';
                    } else if ($typeRerservation == '1Journee0307') {
                        echo 'Vous avez réservé pour le 03/07';
                    } else if ($typeRerservation == '2Journees01070207') {
                        echo 'Vous avez réservé pour le 01/07 et le 02/07';
                    } else if ($typeRerservation == '2Journees02070307') {
                        echo 'Vous avez réservé pour le 02/07 et le 03/07';
                    } else if ($typeRerservation == '3Journees') {
                        echo 'Vous avez réservé pour les trois jours.';
                    } else if ($typeRerservation == '1JourneeReduit') {
                        echo 'Vous avez pris un jour en tarif réduit';
                    } else if ($typeRerservation == '2JourneesReduit') {
                        echo 'Vous avez pris deux jours en tarif réduit';
                    } else if ($typeRerservation == '3JourneesReduit') {
                        echo 'Vous avez pris trois jours en tarif réduit';
                    } ?></li>
            <li><?php
                $message = "";
                $tableauNuitPopUp = str_split($nuit);
                foreach ($tableauNuitPopUp as $indiceTableau) {
                    switch ($indiceTableau) {
                        case "a":
                            $message .= "Vous avez réservé une nuit en tente le 01/07.";
                            break;
                        case "b":
                            $message .= "Vous avez réservé une nuit en tente le 02/07.";
                            break;
                        case "c":
                            $message .= "Vous avez réservé une nuit en tente le 03/07.";
                            break;
                        case "d":
                            $message .= "Vous avez réservé les trois nuits en tente.";
                            break;
                        case "e":
                            $message .= "Vous avez réservé une nuit en van le 01/07.";
                            break;
                        case "f":
                            $message .= "Vous avez réservé une nuit en van le 02/07.";
                            break;
                        case "g":
                            $message .= "Vous avez réservé une nuit en van le 03/07.";
                            break;
                        case "h":
                            $message .= "Vous avez réservé les trois nuits en van.";
                            break;
                    }
                    echo $message;
                }

                ?></li>

            <?php
            if ($nbrEnfant == TRUE) { ?>
                <li>
                    Vous avez indiqué venir avec un ou des enfants, et réservé <?= $nbrCasqueEnfant ?> casque(s).</li>
            <?php
            }
            ?>
            <?php
            if (!empty($nbrDescenteLuge)) {
            ?> <li> <?= "Vous avez choisi de faire " . $nbrDescenteLuge . " descente(s) de luge."; ?></li>
            <?php } ?>
        </ul>



        <h2> Le montant total de votre commande est : <?php $prixTotal = $reservation->calculerPrix();
                                                        echo $prixTotal . " €.";  ?></h2>
    </div>

</body>

</html>