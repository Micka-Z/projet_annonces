<?php
/*

Controleur : Chercher dans la bdd la liste des annonces selon les critères récupérés

Paramètres : 
    POST expression
    POST prix_min
    POST prix_max
    POST date_limite

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
if (empty($_POST["expression"]) || empty($_POST["prix_min"]) || empty($_POST["prix_max"]) || empty($_POST["date_limite"])) {
    include "templates/pages/page_utilisateur.php";
    exit;
}
$expression = $_POST["expression"];
$prix_min = $_POST["prix_min"];
$prix_max = $_POST["prix_max"];
$date_limite = $_POST["date_limite"];

$annonce = new annonce();
$listeAnnoncesRecherchees = $annonce->chercheAnnonces($expression, $prix_min, $prix_max, $date_limite, 1);

// Affichage 
include "templates/pages/liste_annonces.php";