<?php

/*

FOnctions liées à la session

*/

function isConnected() {
    // Rôle: Vérifier si quelqu'un est connecté
    // Retour : true si c'est le cas, false sinon
    // Paramètres : néant

    // SI la session n'est pas définie (est  ide)
    if (empty($_SESSION["id"])) {
        return false;
    } else {
        return true;
    }
}

function utilisateurConnecte() {
    // Rôle : récupérer l'utilisateur connecté
    // Retour : un objet utilisateur, chargé avec l'utilisateur connecté si on est connecté, non chargé sinon
    // Paramètres : néant

    // Récupérer un utilisateur
    $utilisateur = new utilisateur();
    // SI il est connecté
    if (isConnected()) {
        // ALORS on charge l'objet à partir de l'id de la session
        $utilisateur->loadById($_SESSION["id"]);
        //$_SESSION["role"] = $utilisateur->get("role");
    }

    return $utilisateur;
}

function deconnecter() {
    // Rôle : fermer la connection
    // Retour : néant
    // Paramètres : néant

    // Vider $_SESSION["id"]
    $_SESSION["id"] = 0;
    //$_SESSION["role"] = "";
}

function connecter($pseudo, $password) {
    // Rôle : vérifier des codes de connexion et établir la connexion
    // Retour : true si la connexion est établit, false sinon
    // Paramètres : 
    //      $login : login de connexion
    //      $password : mot de passe à essayer

    // Récupérer un utilisateur en fonction de son login
    $utilisateur = new utilisateur();

    // ON cherche l'utilisateur par son login
    if ( ! $utilisateur->loadByLogin($pseudo)) {
        deconnecter();
        return false;
    }

    // On a un utilisateur chargé
    // Vérifier le mot de passe haché est bon
    if (password_verify($password, $utilisateur->get("password"))) {
        deconnecter();
        return false;
    }

    // ON indique que cet utilisateur est connecté
    $_SESSION["id"]  = $utilisateur->id();
    print_r($_SESSION);
    return true;

}

?>