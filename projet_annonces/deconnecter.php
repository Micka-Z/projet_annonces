<?php
/*

Controleur : vérifier les éléments de connexion saisies et la page principale à l'utilisateur

Paramètres : 
    POST pseudo : le pseudo de l'utilisateur
    POST password : le mot de passe de connexion

*/



// Initialisations
include "library/init.php";

deconnecter();

// Affichage 
include "templates/pages/page_connexion.php";