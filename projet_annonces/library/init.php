<?php
/* 
Initialisation générale des programmes (URL)

Ficher à inclure en début de toutes les URL
*/



// Pour la mise au point : afficher les messages d'erreur PHP
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
// Ajout des fichiers de fonctions
//include_once("library/outils.php");
include_once("library/outils.php");
include_once("library/model.php");
include_once("data/utilisateur.php");
include_once("data/annonce.php");
include_once("data/offre.php");
include_once("library/session.php");
include_once("fonctions.php");

// Ouvrir la base de données dans la variable globale $bdd
global $bdd;       
// Connexion à la base de données et ouverture
$bdd = new PDO("mysql:host=localhost;dbname=projets_annonces_mzimmermann;charset=UTF8", "mzimmermann", "SnnjH%ef9e?A");
// En mise au point : pour afficher les erreurs que remonte la base d données
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
