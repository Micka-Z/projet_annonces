<?php

/*

Template de page : Mise en page du formulaire d'inscription

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
    <title>S'inscrire</title>
</head>
<body>
    <div class="container">
        <main>
            <h1 class="text-center text-uppercase">S'inscrire</h1>
            <form action="inscrire.php"  method="post">
                <div class="mb-3">
                    <label class="form-label">Pseudo : </label>
                    <input type="text" class="form-control" id="pseudo" name="pseudo" required />
                    <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mail : </label>
                    <input type="email" class="form-control" id="email" name="email" required />
                    <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mot de passe : </label>
                    <input type="password" class="form-control" id="password" name="password" required />
                    <div class="invalid-feedback"></div>
                </div>
                <input type="submit" class="btn btn-primary" value="Envoyer" />
            </form>
        </main>
    </div>
        <?php
            
            include "templates/fragments/footer.php";
            include "templates/fragments/footer_inscription.php"; 
        ?>
</body>
</html>
