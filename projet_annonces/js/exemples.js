

function recupereFiche(id) {
    // Rôle : récupérer la fiche dont l'id est donné
    // retour : néant
    // Paramètres :
    //      id : id de la fiche

    //console.log(id);
    // Avec la technologie AJAX, on va demander les informations et préparer leur traitement par la fonction d'affichage
    // Construire l'URL (un controller)
    let url = "affiche_detail_demande.php?id=" + id;
    // Construire les paramètres POST : néant

    // Envoyer la requête
    $.ajax(url, {
        method: "GET",
        success: affiche_fiche,
        error: function() { console.error("Erreur de commnunication")},
    });

    // Préparer la popup en mode "chargement en cours"
    $("#popup").show().html("Chargement en cours....");


}



function affiche_fiche(donnees) {
    // Role : traiter les données envoyées par la requête HTTP
    // Retour : néant
    // Paramètres :
    //      donnees : donnees reçues du serveur, donc le fragment à insérer
    $("#popup").hide();
    //console.log(donnees);
    $("#bloc_detail").html(donnees);

    let mod = $("table td").data("id");
    console.log(mod);
}


