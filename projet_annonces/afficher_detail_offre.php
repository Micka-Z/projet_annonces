<?php
/*

Controleur : Récupérer les informations des offres de l'annonce courante

Paramètres : 
    GET id : l'id de l'annonce

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

// On crée l'objet `offre`
$offre = new offre();
// On récupère la liste des offres reçues de l'annonce dont on connait son id
$listeOffresRecues = $offre->getOffreAnnonce($idAnnonce);

$annonce = new annonce($idAnnonce);

// Affichage 
include "templates/fragments/detail_offre.php";