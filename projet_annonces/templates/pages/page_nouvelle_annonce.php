<?php

/*

Template de page : Mise en page du formulaire de création d'une nouvelle annonce

Paramètres : néant

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
    <title>Nouvelle annonce</title>
</head>
<body>
    <div class="container">
        <?php
            include "templates/fragments/header.php";
        ?>
        <main>
            <h1 class="text-center text-uppercase">Nouvelle annonce</h1>
            <form action="enregistrer_annonce.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Titre : </label>
                    <input type="text" class="form-control" name="titre" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Description : </label>
                    <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Prix : </label>
                    <div class="input-group">
                        <input type="number" step="0.01" min="0" class="form-control" name="prix" />
                        <span class="input-group-text">€</span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Photo : </label>
                    <input type="file" class="form-control" name="photo" />
                </div>
                <input type="submit" class="btn btn-primary" value="Ajouter" />
            </form>
        </main>
    </div>
        <?php
            include "templates/fragments/footer.php";
        ?>
</body>
</html>



