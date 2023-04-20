<?php
/*

Controleur : modifier le statut de l'offre

Paramètres : 
    GET id : id de l'offre
    GET statut : le statut de l'offre

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
// SI on ne récupère aucun paramètre, on revient à la liste des annonces
if (!empty($_GET["id"]) || !empty($_GET["statut"])) {
    // On récupère l'id de l'offre
    $idOffre = $_GET["id"];
    // ON récupère le statut de l'offre
    $statut = $_GET["statut"];
    // ON crée un nouvel objet `offre`
    $offre = new offre();
    // On  charge cet objet
    $offre->loadById($idOffre);
    // On modifie le statut en fonction du statut récupéré
    if($statut == 2) {
        $offre->set("statut", "refuse");
    } elseif ($statut == 1) {
        $offre->set("statut", "accepte");
    }
    // ON met à joru dans la bdd
    $offre->update();
}

// On cherche dans la bdd la liste des annonces postées par l'utilisateur connecté pour permettre son affichage
$annonce = new annonce();
$listeAnnoncesPostees = $annonce->getAllFromUser(1);

// Affichage 
include "templates/pages/liste_annonces_utilisateur.php";