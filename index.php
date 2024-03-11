<!DOCTYPE html>
<html lang="fr">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de réservation Music Vercos Festival</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/responsive.css">

</head>

<body>

    <!------------------- HEADER ------------------->
    <header class="header">
        <a href="./connexion.php" class="boutonConnexion">Connexion</a>
        <h1>Vercors Musique Festival</h1>
    </header>
    <!------------------- BODY ------------------->

    <form action="./src/traitement.php" id="inscription" method="POST">
        <div id="reservation" class="blocFormulaire">

            <h2>Réservation</h2>
            <h3>Nombre de réservation(s) :</h3>
            <input type="number" name="nombrePlaces" id="NombrePlaces" min="1" required>
            <h3>Réservation(s) en tarif réduit</h3>
            <div>
                <input type="checkbox" name="tarifReduit" id="tarifreduitRadio">
                <label for="tarifReduit">Ma réservation sera en tarif réduit</label>
            </div>

            <h3>Choisissez votre formule :</h3>
            <div class="divPass1Jour">
                <input type="checkbox" name="pass1jour" id="pass1jour">
                <label for="pass1jour">Pass 1 jour : 40€</label>
            </div>

            <!-- Si case cochée, afficher le choix du jour -->
            <section id="pass1jourDate" class="tarifHidden">
                <input type="checkbox" name="choixJour1" id="choixJour1">
                <label for="choixJour1">Pass pour la journée du 01/07</label>
                <input type="checkbox" name="choixJour2" id="choixJour2">
                <label for="choixJour2">Pass pour la journée du 02/07</label>
                <input type="checkbox" name="choixJour3" id="choixJour3">
                <label for="choixJour3">Pass pour la journée du 03/07</label>
            </section>

            <div class="divPass2Jours">
                <input type="checkbox" name="pass2jours" id="pass2jours">
                <label for="pass2jours">Pass 2 jours : 70€</label>
            </div>

            <!-- Si case cochée, afficher le choix des jours -->
            <section id="pass2joursDate" class="tarifHidden">
                <input type="checkbox" name="choixJour12" id="choixJour12">
                <label for="choixJour12">Pass pour deux journées du 01/07 au 02/07</label>
                <input type="checkbox" name="choixJour23" id="choixJour23">
                <label for="choixJour23">Pass pour deux journées du 02/07 au 03/07</label>
            </section>

            <div class="divPass3Jours">
                <input type="checkbox" name="pass3jours" id="pass3jours">
                <label for="pass3jours">Pass 3 jours : 100€</label>
            </div>


            <!-- tarifs réduits : à n'afficher que si tarif réduit est sélectionné -->
            <div id="tarifreduit" class="tarifHidden">
                <input type="checkbox" name="pass1jourreduit" id="pass1jourreduit">
                <label for="pass1jourreduit">Pass 1 jour : 25€</label> <br>
                <input type="checkbox" name="pass2joursreduit" id="pass2joursreduit">
                <label for="pass2joursreduit">Pass 2 jours : 50€</label> <br>
                <input type="checkbox" name="pass3joursreduit" id="pass3joursreduit">
                <label for="pass3joursreduit">Pass 3 jours : 65€</label>
            </div>


            <!-- FACULTATIF : ajouter un pass groupe (5 adultes : 150€ / jour) uniquement pass 1 jour -->

            <p class="bouton" onclick="suivant(blocReservation, blocOptions)">Suivant</p>
            <div class="messageErreurReservation"></div>

        </div>
        <div id="options" class="blocFormulaire options">

            <h2>Options</h2>
            <h3>Réserver un emplacement de tente : </h3>
            <div class="choixnuit">
                <input type="checkbox" id="tenteNuit1" name="tenteNuit1">
                <label for="tenteNuit1">Pour la nuit du 01/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="tenteNuit2" name="tenteNuit2">
                <label for="tenteNuit2">Pour la nuit du 02/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="tenteNuit3" name="tenteNuit3">
                <label for="tenteNuit3">Pour la nuit du 03/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="tente3Nuits" name="tente3Nuits">
                <label for="tente3Nuits">Pour les 3 nuits (12€)</label>
            </div>

            <h3>Réserver un emplacement de camion aménagé : </h3>
            <div class="choixnuit">
                <input type="checkbox" id="vanNuit1" name="vanNuit1">
                <label for="vanNuit1">Pour la nuit du 01/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="vanNuit2" name="vanNuit2">
                <label for="vanNuit2">Pour la nuit du 02/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="vanNuit3" name="vanNuit3">
                <label for="vanNuit3">Pour la nuit du 03/07 (5€)</label>
            </div>
            <div class="choixnuit">
                <input type="checkbox" id="van3Nuits" name="van3Nuits">
                <label for="van3Nuits">Pour les 3 nuits (12€)</label>
            </div>

            <h3>Venez-vous avec des enfants ?</h3>
            <div class="divenfants">
                <input type="checkbox" name="enfantsOui"><label for="enfantsOui">Oui</label>
            </div>
            <div class="divenfants">
                <input type="checkbox" name="enfantsNon"><label for="enfantsNon">Non</label>
            </div>


            <!-- Si oui, afficher : -->
            <section class="casqueEnfant tarifHidden">
                <h4>Voulez-vous louer un casque antibruit pour enfants* (2€ / casque) ?</h4>
                <label for="nombreCasquesEnfants">Nombre de casques souhaités :</label>
                <input type="number" name="nombreCasquesEnfants" id="nombreCasquesEnfants" min="0">
                <p>*Dans la limite des stocks disponibles.</p>
                <div class="messageErreurCasques"></div>
            </section>

            <h3>Profitez de descentes en luge d'été à tarifs avantageux !</h3>

            <div class="divluge">
                <label for="NombreLugesEte">Nombre de descentes en luge d'été (5€/descentes) :</label>
                <input type="number" name="NombreLugesEte" id="NombreLugesEte" min="0">
                <div class="messageErreurLuge"></div>
            </div>

            <p class="bouton boutonOptions" onclick="suivant2(blocOptions, blocCoordonnees)">Suivant</p>
            <p class="bouton" onclick="precedent(blocOptions, blocReservation)">Précédent</p>

        </div>

        <div id="coordonnees" class="blocFormulaire">

            <h2>Coordonnées</h2>
            <div class="messageErreurChampsVides"><?php if (!empty($_GET['erreur'])) {
                                                        if ($_GET['erreur'] == 4 || $_GET['erreur'] == 2 || $_GET['erreur'] == 1 || $_GET['erreur'] == 3 || $_GET['erreur'] == 5 || $_GET['erreur'] == 6 || $_GET['erreur'] == 7 || $_GET['erreur'] == 8) {
                                                            echo ("Formulaire incorrect");
                                                        }
                                                    }; ?></div>

            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" placeholder="Dupont">
            <label for=" prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" placeholder="Pierre">
            <label for=" email">Email :</label>
            <input type=" email" name="email" id="email" placeholder="email@gmail.com">
            <label for="telephone">Téléphone :</label>
            <input type=" text" name="telephone" id="telephone" placeholder="0612345678">
            <label for="adressePostale">Adresse Postale :</label>
            <input type="text" name="adressePostale" id="adressePostale" placeholder="4 rue Victor Hugo 38000 Grenoble">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" placeholder="Entrer un mot de passe avec 6 caractères minimum">
            <label for="passwordBis">Confirmer votre mot de passe :</label>
            <input type="password" name="passwordBis" id="passwordBis" placeholder="Entrer un mot de passe avec 6 caractères minimum">

            <input type="submit" name="soumission" class="bouton" value="Réserver">
            <p class="bouton" onclick="precedent(blocCoordonnees, blocOptions)">Précédent</p>

        </div>
    </form>

</body>
<script src="./assets/script.js"></script>
<script src="./assets/traitement.js"></script>

</html>