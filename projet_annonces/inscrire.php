<?php
/*

Controleur : enregistrer le nouvel utilisateur en fonction des éléments récupérés, envoyer un mail de confirmation
             --> lancer la session, uniquement dès 

Paramètres : néant

*/



// Initialisations
include "library/init.php";



// Récupération des paramètres :

$utilisateur = new utilisateur();
//Vérification du pseudo

if (empty($_POST["email"]) || empty($_POST["pseudo"]) || empty($_POST["password"])) {
    include "templates/pages/page_inscription.php";
    exit;
}   
//print_r($_POST);
$email = $_POST["email"];
$pseudo = $_POST["pseudo"];
$password = $_POST["password"];
// Génération aléatoire d'une clé
$cle = md5(microtime(TRUE)*100000);
$utilisateur->set("email", $email);
$utilisateur->set("pseudo", $pseudo);
$utilisateur->set("password", $password);
$utilisateur->set("cle", $cle);
$utilisateur->set("actif", 0);
$utilisateur->insert();

// Récupération des paramètres : 
$sujet = "Confirmation de mail";
//$message = "http://votresite.com/activation.php?log='.urlencode($pseudo).'&cle='.urlencode($cle).'";
$dest_mail = "mzimmermann@mywebecom.ovh";
$dest_nom = $pseudo;

// Préparation du mail
//$messageComplet = "Bonjour,
//Vous avez reçu une demande : $message";

// Le lien d'activation est composé du login(log) et de la clé(cle)
$message = 'Bienvenue sur VotreSite,
 
Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
ou copier/coller dans votre navigateur Internet.
 
http://votresite.com/activation.php?pseudo='.urlencode($pseudo).'&cle='.urlencode($cle).'
 
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';

// en-têtes :
$entetes = [];  // Tableau vide pour les en-têtes

// FROM
$entetes["From"] = '"Annonces" ' . "<mzimmermann@mywebecom.ovh>"; // L'aresse mail avec le @ doit être celle du serveur, ou du système

// REPLY TO : destinataire des réponses
$entetes["Reply-To"] = '"Annonces" ' . "<mzimmermann@mywebecom.ovh>";

// Pour des copies : entete Cc
// Pour des copies cachées : entete Bcc

// Mail HTML :
// Ententes spécifiquies
$entetes["MIME-version"] = "1.0";
$entetes["Content-Type"] = "text/html; charset=utf8";

$messageHTML = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf8">
</head>
<body>
    <p>Bonjour</p>
    <p>' . nl2br(htmlspecialchars($message)) . '</p>
</body>
</html>
';

// Destinataire : "nom visible" <adresse>, "nom visible 2" <adresse2>
$destinataire = '"' . $dest_nom . '" ' . "<$dest_mail>";

mail($destinataire, $sujet, $messageHTML, $entetes);



    // Affichage 
    include "templates/pages/page_connexion.php";	









