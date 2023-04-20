<h3 class="my-3">Les offres pour l'annonce N° <?= $annonce->id() ?></h3>
<?php 

// SI on reçoit une liste d'offre pour l'annonce dont on a l'id
if(!empty($listeOffresRecues)) {
    // On initialise un compteur pour afficher le numéro de l'offre
    $compteur = 0;
    // POUR CHAQUE offre, on affiche son détail
    foreach ($listeOffresRecues as $uneOffreRecue) {
        $compteur++;
        ?>
        <ul class="list-group my-3">
            <li class="list-group-item bg-light text-decoration-underline fst-italic"><span class="text-secondary">Offre <?= $compteur ?></span></li>
            <li class="list-group-item">Montant : <span class="fw-bold text-primary"><?= $uneOffreRecue->html("montant") ?></span></li>
            <?php
            // SI l'offre a été accepté (statut = accepte) ALORS on affiche le statut et l'email de l'utilisateur ayant fait l'offre
            if ($uneOffreRecue->get("statut") == "accepte") {
                ?>
                <li class="list-group-item">Statut : <span class="fw-bold text-success"><?= $uneOffreRecue->html("statut") ?></span></li>
                <li class="list-group-item">Mail : <span class="fw-bold text-secondary"><a href="mailto:<?= $uneOffreRecue->get("utilisateur")->html("email") ?>"><?= $uneOffreRecue->get("utilisateur")->html("email") ?></a></span></li>
                <?php
            } elseif ($uneOffreRecue->get("statut") == "refuse") { // SI l'offre est refusée, on affiche son statut
                ?>
                <li class="list-group-item">Statut : <span class="fw-bold text-danger"><?= $uneOffreRecue->html("statut") ?></span></li>
                <?php               
            } else { // SINON, on affiche le statut de l'offre (attente) et on ajoute mes boutons de réponse
                ?>
                <li class="list-group-item">Statut : <span class="fw-bold text-warning"><?= $uneOffreRecue->html("statut") ?></span></li>
                <li class="list-group-item">
                    <button onclick="terminerOffre(<?= $uneOffreRecue->id() ?>, 1)" class="btn btn-outline-success">Accepter</button>
                    <button onclick="terminerOffre(<?= $uneOffreRecue->id() ?>, 2)" class="btn btn-outline-danger">Refuser</button>
                </li>
                
                <?php
            }
            ?>
        </ul>
        <?php
    }
}
?>