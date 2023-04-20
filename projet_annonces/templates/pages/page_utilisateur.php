<?php

/*

Template de page : Mise en page de l'écran principal de l'utilisateur

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
    <title>Gestion des annonces</title>
</head>
<body>
    <div class="container">
        <?php
            include "templates/fragments/header.php";
        ?>
        <main>
            <h1 class="text-center text-uppercase">Gestion des annonces</h1>
            <div class="my-3">
                <h2 class="text-decoration-underline">Rechercher une annonce :</h2>
                <form action="rechercher.php" method="post" onsubmit="compareNombres()">
                    <div class="mb-3">
                        <label class="form-label">Expression : </label>
                        <input type="text" class="form-control" name="expression" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prix : </label>
                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <span class="input-group-text">Entre </span>
                                    <input type="number" min="1" step="0.01" class="form-control" name="prix_min" />
                                    <span class="input-group-text">€</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                        <span class="input-group-text">Et </span>
                                        <input type="number" min="1" step="0.01" class="form-control" name="prix_max" />
                                        <span class="input-group-text">€</span>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Publiée jusqu'à : </label>
                        <input type="date" class="form-control" name="date_limite" />
                    </div>
                    <input type="submit" class="btn btn-primary" value="Rechercher" />
                </form>
            </div>
            <div class="my-3" id="error">
            </div>
        </main>
    </div>
        <?php
            include "templates/fragments/footer.php";
        ?>
</body>
</html>

