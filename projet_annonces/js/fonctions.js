/*

Foncitions utiles 

*/

function recupOffre(idAnnonce) {
    // Rôle : Récupérer les offres de l'annonce dont on connait l'id
    // Retour : néant
    // Paramètres :
    //      idAnnonce : l'id de l'annonce

    //console.log(idAnnonce);
    // COnstruire l'url
    let url = "afficher_detail_offre.php?id=" + idAnnonce;
    
    // Envoyer la requête
    $.ajax(url, {
        method: "GET",
        //data: "id=" + idAnnonce,
        success: afficheOffre,
        error: function() {
            console.error("Erreur de communication")
        },
    });
}

function afficheOffre(donnees) {
    // Traiter les données envoyées par la requête HTTP
    // Retour: néant
    // Paramètres : 
    //      donnees : données reçues du serveur, donc le fragment à insérer
    //console.log(donnees);
    //location.reload(true);
    $("#detail_offre").html(donnees);
}

function terminerOffre(idOffre, statut) {
    // Rôle : envoyer l'id de l'offre au contrôleur
    // Retour : néant
    // Paramètres : 
    //      idOffre : l'id de l'offre

    // Construire l'url
    let url = "modifier_offre.php?id=" + idOffre + "&statut=" + statut;

        // Envoyer la requête
        $.ajax(url, {
            method: "GET",
            //data: "id=" + idAnnonce,
            success: updateOffre,
            error: function() {
                console.error("Erreur de communication")
            },
        });
}

function updateOffre() {
    //console.log(donnees);
    location.reload(true);
}

// Faire : bloquer l'évènement d'envoi de formulaire avec jquery
function compareNombres() {
    // Rôle : Comparer si la saisie de 2 nombres est correcte
    // Retour : true si ok, false sinon
    // Paramètres : néant
    
    let nb_min = document.querySelector("[name=prix_min]").value;
    let nb_max = document.querySelector("[name=prix_max]").value;
    let paragraphError = document.querySelector("#error");
    paragraphError.style.display = "block";

    if (nb_max < nb_min || nb_max <= 0 || nb_min <= 0) {
        paragraphError.textContent = "Mauvaise saisie des nombres";
        paragraphError.style.border = "1px solid red";
        paragraphError.style.display = "block";
        return false;
    } else {
        paragraphError.style.display = "none";
        return true;
    }
}

function verifPseudo() {
    
}

/*function verif() {
    // Rôle: vérifier que le formulaire peut-être envoyé
    // Retour: true si ok, false sinon  (cela sera propagé au onsubmit par le fait d'avoir ecrit return verification()
    // paramètres: néant

    let okNombres = compareNombres();

    // Si les nombres sont bons
    if ( okNombres ) {
        // On retourne vrai
        return true;
    } else {
        // Sinon
        // on retourne false
        return false;
    }


}*/