<?php

class Database
{

    private $_DBU; //Base de données utilisateur
    private $_DBR; //Basse de données réseevation


    /**
     * Fonction qui permet d'attribuer la bonne Database
     *
     * @param   nomClasse    prends en paramètre la classe souhaitée
     *
     * @return  [type]       attribut le dossier csv correspondant
     */
    public function __construct($nomClasse)
    {
        if ($nomClasse == "User") {
            $this->_DBU = __DIR__ . "/../csv/utilisateurs.csv";
        } else if ($nomClasse == "Reservation") {
            $this->_DBR = __DIR__ . "/../csv/reservations.csv";
        }
    }

    /********** DataBaseUtilisateur **********/

    /**
     * Fonction qui récupère tous les utilisateurs du csv 
     *
     * @return  array   retourne un tableau avec tous les utilisateurs, 1 par ligne
     */
    public function getAllUtilisateurs(): array
    {
        $connexion = fopen($this->_DBU, 'r');
        $utiliseurs = [];

        while (($user = fgetcsv($connexion, 1000, ",")) !== FALSE) {
            $utiliseurs[] = new User($user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[0]);
        }

        fclose($connexion);

        return $utiliseurs;
    }

    /**
     * Fonction qui permet de récupérer les utilisateurs par leur ID
     *
     * @param   int   $id  La paramètre doit être un nombre
     *
     * @return  User       retourne les infos utilisateur s'il y a un ID en nombre, sinon $user = false
     */
    public function getThisUtilisateurById(int $id): User|bool
    {
        $connexion = fopen($this->_DBU, 'r');
        while (($user = fgetcsv($connexion, 1000)) !== FALSE) {
            if ((int) $user[0] === $id) {
                $user = new User($user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[0]);
                break;
            } else {
                $user = false;
            }
        }
        fclose($connexion);
        return $user;
    }

    public function getThisUtilisateurByEmail(string $email): User|bool
    {
        $connexion = fopen($this->_DBU, 'r');
        while (($user = fgetcsv($connexion, 1000)) !== FALSE) {
            if ((string) $user[3] === $email) {
                $user = new User($user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[0]);
                break;
            } else {
                $user = false;
            }
        }
        fclose($connexion);
        return $user;
    }


    /**
     * Function qui fait appel à la méthode getObjectToArray() pour créer un csv avec les infos utilisateur
     *
     * @param   User  $user  classe User
     *
     * @return  bool         retourne true ou false
     */
    public function saveUtilisateur(User $user): bool
    {
        $connexion = fopen($this->_DBU, 'ab');

        $retour = fputcsv($connexion, $user->getObjectToArray()); //Formate une ligne en CSV et l'écrit dans un fichier

        fclose($connexion);

        return $retour;
    }




    /********** DataBaseReservation **********/

    /**
     * Fonction qui récupère toutes les réservations du csv 
     *
     * @return  array   retourne un tableau avec toutes les réservations, 1 par ligne
     */
    public function getAllReservations(): array
    {
        $connexion = fopen($this->_DBR, 'r');
        $reservations = [];

        while (($reservation = fgetcsv($connexion, 1000, ",")) !== FALSE) {
            $reservations[] = new Reservation($reservation[2], $reservation[3], $reservation[4], $reservation[5], $reservation[6], $reservation[7], $reservation[1], $reservation[0]);
        }

        fclose($connexion);

        return $reservations;
    }

    /**
     * Fonction qui permet de récupérer les réservations par leur ID
     *
     * @param   int   $id  La paramètre doit être un nombre
     *
     * @return  User       retourne les infos réservation s'il y a un ID en nombre, sinon $user = false
     */
    public function getThisReservationById(int $id): Reservation|bool
    {
        $connexion = fopen($this->_DBR, 'r');
        while (($reservation = fgetcsv($connexion, 1000)) !== FALSE) {
            if ((int) $reservation[0] === $id) {
                $reservation = new Reservation($reservation[2], $reservation[3], $reservation[4], $reservation[5], $reservation[6], $reservation[7], $reservation[1], $reservation[0]);
                break;
            } else {
                $reservation = false;
            }
        }
        fclose($connexion);
        return $reservation;
    }

    /**
     * Function qui fait appel à la méthode getObjectToArray() pour créer un csv avec les infos de réservations
     *
     * @param   Reservation  $reservation  classe Reservation
     *
     * @return  bool         retourne true ou false
     */
    public function saveReservation(Reservation $reservation): bool
    {
        $connexion = fopen($this->_DBR, 'ab');

        $retour = fputcsv($connexion, $reservation->getObjectToArray());

        fclose($connexion);

        return $retour;
    }
}








?>

