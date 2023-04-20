<?php
/*

Controleur : afficher la liste des offres effectuées par l'utilisateur connecté

Paramètres : néant

*/

//print_r($_SESSION);

// Initialisations
include "library/init.php";

/*if (!isConnected()) {
    // ALORS on affiche le formulaire de connexion
    include "templates/pages/page_connexion.php";
    exit;
} 

$user = utilisateurConnecte();*/

print_r($_SESSION);

// Récupération des paramètres : néant
$offre = new offre();
$listeOffresEffectuees = $offre->getListeOffresUtilisateur(1);

// Affichage 
include "templates/pages/liste_offres.php";