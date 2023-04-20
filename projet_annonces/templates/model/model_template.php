<?php

// Template de page : mise en forme d'une liste d'articles


// Paramètres :
//      $liste : tableau d'objets de la classe article (les articles à afficher), sous forme d'une table HTML


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Liste des articles</title>
</head>
<body>
    <div id="main">
        <h1>Liste des articles</h1>
        <table>
            <tr>
                <th>désignation</th>
                <th>prix</th>
            </tr>
            <?php
                // Pour chaque article de la listye des aricles, on veut produire : <tr onclick="affiche_article(idArticle)"><td>désignation de l'article</td><td>Prix €</td></tr>
                foreach($liste as $article) {
                    echo "<tr onclick='affiche_article(" . $article->id() .")'><td>" . $article->html("designation") . "</td><td>" . $article->html("prix") . " €</td></tr>";
                }
            ?>
        </table>
    </div>
    <?php include "templates/fragments/footer.php"; ?>
</body>
</html>