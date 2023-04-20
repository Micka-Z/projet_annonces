<?php
/*

Controleur : modifier dans la bdd le statut de l'utilisateur le rendant actif (mail confirmé)

Paramètres : 
    GET pseudo : le pseudo dans le lien d'activation
    GET cle : la clé d'activation du compte

*/



// Initialisations
include "library/init.php";

// Récupération des paramètres : néant
$pseudo = $_GET["pseudo"];
$cle = $_GET["cle"];

$utilisateur = new utilisateur();
$utilisateur->loadByLogin($pseudo);
$cleBdd = $utilisateur->get("cle");

if ($cle == $cleBdd) {
    $utilisateur->set("actif", 1);
}

// Affichage 
include "templates/pages/pages_connexion.php";