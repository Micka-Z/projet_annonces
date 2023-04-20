<?php
/*

Controleur : créer dans la bdd une nouvelle offre 

Paramètres : 
    GET id : l'id de l'annonce
    GET montant : le montant de l'offre

*/



// Initialisations
include "library/init.php";

/*if (!isConnected()) {
    // ALORS on affiche le formulaire de connexion
    include "templates/pages/page_connexion.php";
    exit;
} 

$user = utilisateurConnecte();*/

// Récupération des paramètres : 
$idAnnonce = $_GET["id"];

if (empty($_POST["montant"])) {
    include "templates/pages/page_utilisateur.php";
    exit;
}

$montant = $_POST["montant"];

$offre = new offre();
$offre->set("annonce", $idAnnonce);
$offre->set("utilisateur", 1);
$offre->set("montant", $montant);
$offre->set("statut", "attente");
$offre->insert();

$listeOffresEffectuees = $offre->getListeOffresUtilisateur(1);

// Affichage 
include "templates/pages/liste_offres.php";