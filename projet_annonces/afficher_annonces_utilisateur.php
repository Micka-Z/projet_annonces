<?php
/*

Controleur : accueil du site, préparation de la page principale de l'application

Paramètres : néant

*/



// Initialisations
include "library/init.php";

/*if (!isConnected()) {
    // ALORS on affiche le formulaire de connexion
    include "templates/pages/page_connexion.php";
    exit;
} 

$user = utilisateurConnecte();*/

// Récupération des paramètres : néant
$annonce = new annonce();

$listeAnnoncesPostees = $annonce->getAllFromUser(1);

// Affichage 
include "templates/pages/liste_annonces_utilisateur.php";