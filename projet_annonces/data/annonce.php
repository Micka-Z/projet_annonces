<?php
/*
Classe  : gestion de l'objet 

*/


class annonce extends _model {

    protected $champs = ["titre", "description", "photo", "prix", "publication", "etat", "utilisateur"];      // Liste des champs (hors id)
    protected $table = "annonce";                       // Nom de la table dans la BDD
    protected $liens = ["utilisateur" => "utilisateur"];

    function getAllFromUser($idUser) {
        // Rôle : extraire tous les objets de la table
        // Retour : tableau (indexé par les id) d'objets du type de cette classe
        // paramètres : néant


        // Passer la requête qui extrait tout
        // Construit le code SQL
        // SELECT `id`, `nomCh1`, `nomCh2`, .....  FROM `nomtable`
        $sql = "SELECT `id`";
        // Pour chaque champ, on ajoute , `nomChamp`
        foreach($this->champs as $nomChamp) {
            $sql .= ", `$nomChamp`";
        }

        $sql .= " FROM `$this->table`";

        $sql .= " WHERE `utilisateur` = :idUser";
        $param = [
            ":idUser" => $idUser
        ];

        // On l'exécute
        $req = $this->executeRequest($sql, $param);

        if ($req == false) {
            // Erreur technique
            return [];
        }


        // On part d'un tableau de résultat vide
        $result = [];
        // Pour chaque ligne extraite :
        foreach($req->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
            //      créer un ojet correspondant à la ligne
            $class = get_class($this);
            $obj = new $class();       // on crée un objet de la classe courante (mise dans $class). ON peut aussi faire $obj = new self();
            // Remplir l'objet
            // Son id
            $obj->id = $ligne["id"];
            // Les champs "classiques"
            $obj->loadFromTab($ligne);
            //      ajouter cet objet dans le tableau de résultat (avec le bon index)
            $result[$ligne["id"]] = $obj;
        }

        // Retourne ce résultat
        return $result;

    }

    function hasOffre() {
        // Rôle : identifier si l'annonce courante a reçu des offres
        // Retour : true si offre, false sinon
        // Paramètres : néant

        // On crée l'objet offre
        $offre = new offre();
        // On récupère toutes les offres
        $listeOffres = $offre->getOffreAnnonce($this->id);

        $statut = false;
        if (!empty($listeOffres)) {
            $statut = true;
        }

       // print_r($result);

        return $statut;
    }



    function chercheAnnonces($expression, $prix_min, $prix_max, $date_limite, $idUtilisateur) {
        // Rôle : extraire la liste des annonces en fonction des critères récupérés
        // Retour : une liste
        // Paramètres :
        //      $expression : une expression
        //      $prix_min : le prix mini des annonces
        //      $prix_max : le prix maxi des annonces
        //      $date_limite : la date limite de publication

        // Construit le code SQL
        // SELECT `id`, `nomCh1`, `nomCh2`, .....  FROM `nomtable`
        $sql = "SELECT `id`";
        // Pour chaque champ, on ajoute , `nomChamp`
        foreach($this->champs as $nomChamp) {
            $sql .= ", `$nomChamp`";
        }

        $sql .= " FROM `$this->table`";

        $sql .= " WHERE (NOT `utilisateur` = :idUtilisateur) AND (`titre` LIKE CONCAT('%', :expression, '%') OR `description` LIKE CONCAT('%', :expression, '%')) AND (`prix` BETWEEN :prix_min AND :prix_max) AND (`publication` < :date_limite) ";

        $param = [
            "idUtilisateur" => $idUtilisateur,
            ":expression" => $expression,
            ":prix_min" => $prix_min,
            ":prix_max" => $prix_max,
            ":date_limite" => $date_limite
        ];

        // On l'exécute
        $req = $this->executeRequest($sql, $param);

        if ($req == false) {
            // Erreur technique
            return [];
        }


        // On part d'un tableau de résultat vide
        $result = [];
        // Pour chaque ligne extraite :
        foreach($req->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
            //      créer un ojet correspondant à la ligne
            $class = get_class($this);
            $obj = new $class();       // on crée un objet de la classe courante (mise dans $class). ON peut aussi faire $obj = new self();
            // Remplir l'objet
            // Son id
            $obj->id = $ligne["id"];
            // Les champs "classiques"
            $obj->loadFromTab($ligne);
            //      ajouter cet objet dans le tableau de résultat (avec le bon index)
            $result[$ligne["id"]] = $obj;
        }

        // Retourne ce résultat
        return $result;
    }

}