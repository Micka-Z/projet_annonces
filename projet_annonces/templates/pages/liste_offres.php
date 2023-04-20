<?php

/*

Template de page : Mise en page de la liste des offres effectuées par l'utilisateur connecté

Paramètres : 
    $listeOffresEffectuees : la liste récupérées dans la BDD de l'utilisateur connecté


*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Liste des offres effectuées</title>
</head>
<body>
    <div class="container">
        <?php
            include "templates/fragments/header.php";
        ?>
        <main>
            <h1 class="text-center text-uppercase">Liste des offres effectuées</h1>
            <div class="my-3">
            <?php 
                //print_r($listeOffresEffectuees);
                // On reçoit une liste d'objets, donc on va la parcourir
                // POUR CHAQUE élément de la liste
                foreach ($listeOffresEffectuees as $uneOffre) {
                    // On met en place la mise en page de la liste
                ?>
                    <ul class="list-group my-3">
                        <li class="list-group-item bg-light"><span class="text-decoration-underline fst-italic">Montant proposé :</span> <span class="text-primary"><?= $uneOffre->html("montant") ?></span></li>
                        <li class="list-group-item">Annonce N°: <?= $uneOffre->get("annonce")->id() ?> </li>
                        <li class="list-group-item fw-bold text-center"><?= $uneOffre->get("annonce")->html("titre") ?></li>
                        <li class="list-group-item">
                            <div class="card" style="width: 18rem;">
                                <img src="img/<?= $uneOffre->get("annonce")->get("photo") ?>" class="card-img-top" alt="<?= $uneOffre->get("annonce")->html("titre") ?>">
                            </div>
                        </li>
                        <li class="list-group-item"><?= $uneOffre->get("annonce")->html("description") ?></li>
                        <li class="list-group-item text-danger fw-bold">Prix: <?= $uneOffre->get("annonce")->html("prix") ?>€</li>
                        <?php
                        // SI létat de l'offre est "terminé", on modifie la couleur de l'annonce en vert (terminée)
                        if ($uneOffre->get("statut") == "accepte") {
                            ?>
                            <li class="list-group-item">Etat: <span class="text-success">Acceptée</span></li>
                            <li class="list-group-item">Mail: <span class="fw-bold text-secondary"><a href="mailto:<?= $uneOffre->get("annonce")->get("utilisateur")->html("email") ?>"><?= $uneOffre->get("annonce")->get("utilisateur")->html("email") ?></a></span></li>
                            <?php
                        } elseif ($uneOffre->get("statut") == "refuse") { // SINON (pas terminé) on met en bleu 
                            ?>
                            <li class="list-group-item">Etat: <span class="text-danger">Refusée</span></li>
                            <?php
                        } else {
                            ?>
                            <li class="list-group-item">Etat: <span class="text-primary">Envoyée</span></li>
                            <?php  
                        }
                        ?>
                    </ul> 
                <?php
                }
                ?>
                

            </div>
        </main>
    </div>
        <?php
            include "templates/fragments/footer.php";
        ?>
</body>
</html>




