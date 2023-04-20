<?php
// Fonctions diverses

function debug($message) {
    // Rôle : inscrire un message dans le fichier de trace
    // Retour : néant
    // Paramètre :
    //      $message : message à afficher
    
    file_put_contents("debug/debug.txt", date("Y-m-d H:i:s") . ": " . $message . "\n", FILE_APPEND);
}
/*
// Pour afficher un objet avec ce debug
debug(print_r($obj, true));
*/

// Pour debuger l'URL complète