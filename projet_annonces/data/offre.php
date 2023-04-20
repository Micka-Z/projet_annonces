<?php
/*
Classe  : gestion de l'objet 

*/


class offre extends _model {

    protected $champs = ["montant", "statut", "utilisateur", "annonce"];      // Liste des champs (hors id)
    protected $table = "offre";                       // Nom de la table dans la BDD
    protected $liens = ["utilisateur" => "utilisateur", "annonce" => "annonce"];


    function getOffreAnnonce($idAnnonce) {
        // Rôle : Récupérer la liste des offres d'une annonce donnée
        // Retour : tableau indexé par l'id d'objets "offre"
        // PAramètres : 
        //      $idAnnonce : l'id de l'annonce

        // requête sur la table offre, qui récupère toutes les lignes dont le champ annonce vaut l'id cherché
        // Construit le code SQL
        $sql = "SELECT `id`";
        // Pour chaque champ, on ajoute , `nomChamp`
        foreach($this->champs as $nomChamp) {
            $sql .= ", `$nomChamp`";
        }

        $sql .= " FROM `$this->table`";

        $sql .= " WHERE `annonce` = :idAnnonce";
        $param = [
            ":idAnnonce" => $idAnnonce
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

    function getListeOffresUtilisateur($idUtilisateur) {
        // Rôle : Récupérer dans la bdd la liste des offres effectuées par l'utilsiateur
        // Retour : tableau indexé par l'id d'objets "offre"
        // PAramètres : 
        //      $idUtilisateur : l'id de l'utilisateur

        // requête sur la table offre, qui récupère toutes les lignes dont le champ utilisateur vaut l'id cherché
        // Construit le code SQL
        $sql = "SELECT `id`";
        // Pour chaque champ, on ajoute , `nomChamp`
        foreach($this->champs as $nomChamp) {
            $sql .= ", `$nomChamp`";
        }

        $sql .= " FROM `$this->table`";

        $sql .= " WHERE `utilisateur` = :idUtilisateur";
        $param = [
            ":idUtilisateur" => $idUtilisateur
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


