<?php
/*

Controleur : vérifier les éléments de connexion saisies et la page principale à l'utilisateur

Paramètres : 
    POST pseudo : le pseudo de l'utilisateur
    POST password : le mot de passe de connexion

*/



// Initialisations
include "library/init.php";

// Récupération des paramètres : 
$pseudo = $_POST["pseudo"];
$password = $_POST["password"];

//$utilisateur = new utilisateur();

if (!connecter($pseudo, $password)) {
    echo "Erreur, le mot de passe saisi n'est pas juste";
    include "templates/pages/page_connexion.php";
} else {
    $user = utilisateurConnecte();
}

// Dans le cadre de cet exercice, on rend l'utilisateur actif dans la connexion
$id = $_SESSION["id"];

$utilisateur = new utilisateur($id);
$utilisateur->set("actif", 1);

// Affichage 
include "templates/pages/page_utilisateur.php";