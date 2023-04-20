<?php

/*

Template de page : Mise en page de la liste des annonces recherchées

Paramètres : 
    $listeAnnoncesRecherchees : la liste récupérées dans la BDD en fonction des critères saisis


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
    <title>Liste des annonces recherchées</title>
</head>
<body>
    <div class="container">
        <?php
            include "templates/fragments/header.php";
        ?>
        <main>
            <h1 class="text-center text-uppercase">Liste des annonces recherchées</h1>
            <div class="my-3">
            <?php 
                //print_r($listeAnnoncesRecherchees);
                // On reçoit une liste d'objets, donc on va la parcourir
                // POUR CHAQUE élément de la liste
                foreach ($listeAnnoncesRecherchees as $uneAnnonce) {
                    // On met en place la mise en page de la liste
                ?>
                    <ul class="list-group my-3">
                        <li class="list-group-item bg-light text-decoration-underline fst-italic">Annonce N°: <?= $uneAnnonce->id() ?></li>
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
                        <form action="enregistrer_offre.php?id=<?= $uneAnnonce->id() ?>" method="post">
                            <div class="mb-3 col-3">
                                <label class="form-label">Proposer un prix : </label>
                                <div class="input-group">
                                    <input type="number" step="0.01" min="0" class="form-control" name="montant" />
                                    <span class="input-group-text">€ </span>
                                    <input type="submit" class="btn btn-primary" value="Faire une offre" />
                                </div>
                            </div>
                            
                        </form>
                    </div>
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


