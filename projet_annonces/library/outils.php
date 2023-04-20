<?php
//Fonctions utiles diverses


function requestSelect($sql, $param) {
    // Rôle: préparer et exécuter dans la base de données une requête SQL de type SELECT
    // Retour : tableau simple (liste) des élements trouvés (chaque élément de la liste est un tableau comportant les champs demandés dans la requête)      
    //          cad le résultat d'un fetchAll sur la requête   
    //          en cas d'erreur : tableau vide 
    // Paramètres :
    //      $sql : requête SQL commençant par SELECT (avec éventuellement des paramètres :xxx)
    //      $param : tableau valoriant les paramètres SQL :xxx

    // récupérer la base de données ouverte
    global $bdd;

    // Créer une requête préparée
    $req = $bdd->prepare($sql);
    if ($req === false) {
        return [];
    }

    // Exécuter la requête (en apssant les paramètres)
    if ( $req->execute($param) == false) {
        return [];
    }

    // récupérer le tableau de résultat
    return $req->fetchAll(PDO::FETCH_ASSOC);

}


function requestUpdate($sql, $param) {
    // Rôle: préparer et exécuter dans la base de données une requête SQL de type UPDATE ou DELETE
    // Retour : true si cela s'est bien passé, false sinon
    // Paramètres :
    //      $sql : requête SQL commençant par UPDATE (avec éventuellement des paramètres :xxx)
    //      $param : tableau valorisant les paramètres SQL :xxx

    // récupérer la base de données ouverte
    global $bdd;

    // Créer une requête préparée
    $req = $bdd->prepare($sql);
    if ($req === false) {
        return false;
    }

    // Exécuter la requête (en apssant les paramètres)
    if ( $req->execute($param) == false) {
        return false;
    }

    // c'est bon : on retourne true
    return true;

}

function requestInsert($sql, $param) {
    // Rôle: préparer et exécuter dans la base de données une requête SQL de type INSERT
    // Retour : null si erreur, l'id de la ligne créée si la création s'est bien passée
    // Paramètres :
    //      $sql : requête SQL commençant par UPDATE (avec éventuellement des paramètres :xxx)
    //      $param : tableau valorisant les paramètres SQL :xxx

    // récupérer la base de données ouverte
    global $bdd;

    // Créer une requête préparée
    $req = $bdd->prepare($sql);
    if ($req === false) {
        return null;
    }

    // Exécuter la requête (en apssant les paramètres)
    if ( $req->execute($param) == false) {
        return null;
    }

    // c'est bon : on retourne l'id créé
    return $bdd->lastInsertId();
}

