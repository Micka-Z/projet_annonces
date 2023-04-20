<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title></title>
</head>
<body>
    <div class="container">
        <header>
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse">
                        <div class="navbar-nav">
                            <a class="nav-link" href="index.php">Accueil</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <h1 class="text-center text-uppercase"></h1>
            <?php
            foreach ($listes as $element) {
                ?>
                <ul class="list-group my-3">
                    <li class="list-group-item bg-light fw-bold"><a href="lien.php?id=<?= htmlentities($element->id()) ?>"><?= htmlentities($element->getAttribut()) ?></a></li>
                    <li class="list-group-item"><?= htmlentities($element->getAttribut()) ?></li>
                </ul>
                <?php
            }
            ?>
        </main>
    </div>
</body>
</html>

<form action="saisir_plat.php" method="post">
    <div class="mb-3">
        <label class="form-label">Nom du plat : </label>
        <input type="text" class="form-control" name="nom" required />
    </div>
    <div class="mb-3">
        <label class="form-label">Description du plat : </label>
        <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Prix du plat : </label>
        <input type="number" step=".01" class="form-control" name="prix" />
    </div>
    <input type="submit" class="btn btn-primary" />
</form>

<table class="table">
    <tr>
        <th scope="col">Désignation</th>
        <th scope="col">Fournisseur</th>
        <th scope="col">Prix d'achat</th>
        <th scope="col">Action</th>
    </tr>
    <tr>
        <td><?= htmlentities($produit->getDesignation()) ?></td>
        <td><?= htmlentities($produit->getFournisseur()->getNom()) ?></td>
        <td><?= htmlentities($produit->getPrixAchat()) ?>€</td>
        <td><a href="afficher_form_modif_produit.php?id=<?= htmlentities($produit->id()) ?>" class="btn btn-primary">Voir le détail</a></td>
    </tr>
</table>

