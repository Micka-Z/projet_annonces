<?php
/*
Classe  : gestion de l'objet 

*/


class utilisateur extends _model {

    protected $champs = ["pseudo", "password", "email", "actif", "cle"];      // Liste des champs (hors id)
    protected $table = "utilisateur";                       // Nom de la table dans la BDD

    function set($nomChamp, $valeur) {
        // Setter pour tous les champs

        // On va traiter le cas password
        if($nomChamp == "password") {
            //print_r($nomChamp);
            return $this->setPassword($valeur);
        }

        if($nomChamp == "pseudo") {
            return $this->setPseudo($valeur);
        }

        // cas normal : on appelle le code du parent
        return parent::set($nomChamp, $valeur);


    }
    protected function setPassword($valeur) {
        // Rôle : setter : Cryptage et et affectation à l'attribut mot de passe d'une nouveau mot de passe
        // Retour : true si ok, false sinon
        // Paramètres : 
        //      $valeur : nouvelle valeur

        $this->valeurs["password"] = password_hash($valeur, PASSWORD_DEFAULT);
        //print_r($this->get("password"));
        return true;

    }

    function setPseudo($valeur) {
        // Rôle : changer le login
        // Retour : tr=ue si ok; false sinon
        // Paramètres : 
        //      $valeur : nouvelle valeur

        // Vérifier l'unicité : vérifier que ce login n'est pas déjà dans la BDD pour un autre objet
        /*if ($this->pseudoAlreadyExists($valeur)) {
            return false;
        } */

        $this->valeurs["pseudo"] = $valeur;
        return true;
    }
    function pseudoAlreadyExists($pseudo) {
        // Rôle : vérifier si un login est d&éjà présent dans la table  pour un autre user
        // Retour : true si existe, false sinon
        // Paramètres :
        //      $login : login à tester

        $sql = "SELECT `id` FROM `utilisateur` WHERE `pseudo` = :pseudo";

        $lignes = requestSelect($sql, [":pseudo" => $pseudo]);
        //print_r($lignes);
        if (empty($lignes)) {
            // Pas de lignes : on a pas ce login dans la bdd pour un autre objet
            return false;
        } else {
            // Le login existe pour un autre user
            return true;
        }
    }

    function verifPassword($pseudo, $password) {
        // Rôle : vérifier si le mot de passe saisi est correct
        // Retour: true si c'est bon, false sinon
        // Paramètres :
        //      $pseudo : le pseudo
        //      $password : le mot de passe

        // Traitement proprement dit (à mettre dans une méthode del calsse gérant les utilisateurs, ou dans la librairie / calsse gérant la session)
        // Chercher l'utuilisateur ayant le login indiqué
        // On fait une requête SELECT qui filtre sur le login (unique)
        $sql = "SELECT `id`, `login`, `password` FROM `utilisateur` WHERE `pseudo` = :pseudo  ";
        $lignes = requestSelect($sql,  [ ":pseudo" => $pseudo]);
        if (empty($lignes)) {
            echo "Pas de pseudo $pseudo dans la BDD";
            exit;
        }

        // On a une ligne (au moins) : on traite la 1ère
        $tabUser = $lignes[0];

        // On vérifie le mote de passe : le mote de passe en clair à vérifier est dans $password, le mot de passe haché est récupéré dans la BDD
        if (password_verify($password, $tabUser["password"])) {
            return true;
        } else {
            return false;
        }
    }
}


