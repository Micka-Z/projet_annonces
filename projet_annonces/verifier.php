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
$utilisateur = new utilisateur();
//Vérification du pseudo
if(!empty($_POST["pseudo_check"])){ 
    
	$pseudo = $_POST['pseudo_check'];
	$pseudo = preg_replace('#[^a-z0-9]#i', '', $pseudo); // filter everything but letters and numbers
	//print_r($pseudo);
	if(strlen($pseudo) < 6 || strlen($pseudo) > 18){
        echo "pas bon";
		//print_r("pas ok");
        include "templates/pages/page_inscription.php";
        exit();
	} elseif ($utilisateur->pseudoAlreadyExists($pseudo)) {
        echo "pseudo existe deja";
        //print_r("pas ok");
        include "templates/pages/page_inscription.php";
        exit();
    } else {
        //print_r("success");

        echo 'success'; 
	}
}