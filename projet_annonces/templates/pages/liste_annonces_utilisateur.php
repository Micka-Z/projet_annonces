<?php

/*

Template de page : Mise en page de la liste des annonces postées par l'utilisateur

Paramètres : 
    $listeAnnoncesPostees : la liste récupérées dans la BDD de l'utilisateur connecté


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
    <title>Liste des annonces postées</title>
</head>
<body>
    <div class="container">
        <?php
            include "templates/fragments/header.php";
        ?>
        <main>
            <h1 class="text-center text-uppercase">Liste des annonces postées</h1>
            <div class="my-3">
            <?php 
                //print_r($listeAnnoncesPostees);
                // On reçoit une liste d'objets, donc on va la parcourir
                // POUR CHAQUE élément de la liste
                foreach ($listeAnnoncesPostees as $uneAnnonce) {
                    // On met en place la mise en page de la liste
                ?>
                    <ul class="list-group my-3">
                        <?php
                        // SI létat de l'offre est "terminé", on modifie la couleur de l'annonce en vert (terminée)
                        if ($uneAnnonce->get("etat") == "termine") {
                            ?>
                            <li class="list-group-item bg-light text-decoration-underline fst-italic"><span class="text-success">Annonce N°: <?= $uneAnnonce->id() ?> (terminée)</span></li>
                            <?php
                        } else { // SINON (pas terminé) on met en bleu 
                            ?>
                            <li class="list-group-item bg-light text-decoration-underline fst-italic"><span class="text-primary">Annonce N°: <?= $uneAnnonce->id() ?></span></li>
                            <?php
                        }
                        ?>
                        <li class="list-group-item fw-bold text-center"><?= $uneAnnonce->html("titre") ?></li>
                        <li class="list-group-item">
                            <div class="card" style="width: 18rem;">
                                <img src="img/<?= $uneAnnonce->get("photo") ?>" class="card-img-top" alt="<?= $uneAnnonce->html("titre") ?>">
                            </div>
                        </li>
                        <li class="list-group-item"><?= $uneAnnonce->html("description") ?></li>
                        <li class="list-group-item text-danger fw-bold"><?= $uneAnnonce->html("prix") ?>€</li>
                    </ul>
                    <div class="row">
                        <?php 
                        // SI l'annonce a reçu au moins une offre, ALORS on affiche le bouton permettant de voir les offres
                        if($uneAnnonce->hasOffre()) {
                            ?>
                            <div class="col-3">
                                <button onclick="recupOffre(<?= $uneAnnonce->id() ?>)" class="btn btn-warning">Offre reçue</button>
                            </div>
                            
                            <?php
                        } else { // SINON on laisse un message qui indique qu'il n'y a pas d'offre
                            ?>
                            <p class="fst-italic">Pas d'offre reçue</p>
                            <?php
                        }
                        ?>
                    </div>

                <?php
                }
                ?>
                <!-- BLOC recevant le détail des offres -->
                <div id="detail_offre"></div>
            </div>
        </main>
    </div>
        <?php
            include "templates/fragments/footer.php";
        ?>
</body>
</html>



