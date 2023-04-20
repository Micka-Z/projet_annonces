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


// Affichage 
include "templates/pages/page_nouvelle_annonce.php";