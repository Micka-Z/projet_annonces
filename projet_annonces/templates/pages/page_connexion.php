<?php

/*

Template de page : Mise en page du formulaire de connexion

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
    <title>Connexion</title>
</head>
<body>
    <div class="container">
        <main>
            <h1 class="text-center text-uppercase">Connexion</h1>
            <form action="connecter.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Pseudo : </label>
                    <input type="text" class="form-control" name="pseudo" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Mot de passe : </label>
                    <input type="password" class="form-control" name="password" />
                </div>
                <input type="submit" class="btn btn-primary" value="Se connecter" />
            </form>
            <a href="afficher_form_inscription.php" class="btn btn-secondary my-3">S'inscrire</a>
        </main>
    </div>
        <?php
            include "templates/fragments/footer.php";
        ?>
</body>
</html>