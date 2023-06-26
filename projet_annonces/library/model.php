<?php

/*
Classe "mère" (le modèle) pour les classes de gestion d'un objet du modèle de données


Méthodes disponibles :
    get(nomChamp) : retourne la valeur du champ de nom indiqué, ou "" si le champ n'existe pas
    id() : récupère l'id
    is() : retourne true si l'objet est chargé, false sinon
    set(nomChamp, valeur) : change la valeur du champ de nom nomChamp (ne fait rien si le champ n'existe pas)

    loadById(id) : charge l'objet courant avec la ligne de la table ayant la clé primaire id (retourne true si on a trouvé un, false sinon)
    insert() : ajoute l'objet courant dans la base de données
    update() : met à jour l'objet courant das la base de données
    delete() : supprime l'objet courant de la base de données

    getAll() : récupérer tous les objets de la table, sous la forme d'un tableau d'objets (de cet objet) indexé par l'id de l'objet

*/


class _model {

    protected $champs = [  ];      // Liste des champs (hors id)
    protected $table = "";         // Nom de la table dans la BDD
    protected $liens = [];         // Chaque lien est reprsenté par "nomChamp" => "tablePointée"

    protected $id = 0;                  // Valeur de l'id de l'objet chargé (0 si pas d'objet chargé)
    protected $valeurs = [];            // Tableau pour stocker les valeurs des autres champs 
                                        //    (les index sont les noms des champs, les valeaurs assovciée le conenu du champ dans la BDD)

                                        
    function __construct($id = null) {            // Constructeur : attention il y a 2 _
        // Cette méthode s'exécute automatiquement juste après la création de l'objet
        // Rôle : charger l'objet d'id donné (si on donne un id)
        // Retour : toujours néant
        // Paramètres :
        //      $id : id à charger (optionnel)

        // Si on a un id -non null) à charger
        //      Charger l'objet courant
        if (isset($id)) {
            $this->loadById($id);
        }


    }

    function get($nomChamp) {
        // Rôle : retourne la valeur du champ de nom indiqué, ou l'objet pointé pour les champs quei sont des liens
        // Retour : a valeur du champ de nom indiqué, ou "" si le champ n'existe pas
        // Paramètre :
        //      $nomChamp : nom du champ à retourner

        // détecter si le champ est un lien (vers une autre table) :
        if (isset($this->liens[$nomChamp]) ) {
            return $this->getLink($nomChamp);
        }

        // Si il existe et il a une valeur
        // Le champ existe : on a son nom dans l'attribut champs
        // Il a une  valeur : on a l'index correspondat au champ dans $this->valeurs
        if ( in_array($nomChamp, $this->champs)   and isset($this->valeurs[$nomChamp])) {
            //      retourne sa valeur
            return $this->valeurs[$nomChamp];
        } else {
            // sinon :
            //      retourne ""
            return "";
        }
    }

    function html($nomChamp) {
        // Rôle : récupérer le contenu du champ en format HTML (pour les liens, c'est l'id)
        // Retour: texte formaté HTML
        // Paramètres : 
        //      $nomChamp : nom du champ

        if (!empty($this->valeurs[$nomChamp])) {
            // On a une valeur : on la formate en HTML
            return nl2br(htmlspecialchars($this->valeurs[$nomChamp]));
        } else {
            return "";
        }
    }

    function getLink($nomChamp) {
        // Rôle : retourner l'objet pointé par un champ donné de l'obket courant
        // Retour : l'objet pointé, chargé si il existe, si nomChamp n'est pointeur : retourner null
        // Paramètres :
        //      $nomChamp : nom du champ à retourner

        // Si $nomChmpa n'est un nom de line, on reourne null
        if ( ! isset($this->liens[$nomChamp]) ) {
            return null;
        }
        
        // On récupère la classe de l'objet lié
        $modelObjet = $this->liens[$nomChamp];
        // On récupère un objet de cette classe
        $objet = new $modelObjet();
        //print_r($this->valeurs[$nomChamp]);
        // ON le charge si on a une valeur pour ce champ
        if ( isset($this->valeurs[$nomChamp])) {
            
            $objet->loadById( $this->valeurs[$nomChamp] );
        }
        // ON le retourne
        return $objet;

    }

    function id() {
        // Rôle : retourner l'id (ou 0)
        // Retour : valeur de l'id (ou 0)
        // paramètres : néant

        if (empty($this->id)) {
            return 0;
        } else {
            return $this->id;
        }
    }

    function is() {
        // Rôle : indiquer si l'objet "existe" ou pas (chargé et venant de la BDD)
        // Retour : true si objet chargé, false sinon
        // Paramètres : néant

        // l'objet est chargé si il a un id non vide
        return ! empty($this->id);

    }

    function set($nomChamp, $val) {
        // Role : modifier / initialiser la valeur d'un champ donné
        // Retour : true si on a réussi, false sinon (on n'a rien fait)
        // Paramètres :
        //    $nomChamp : nom du champ à valoriser
        //    $val : valeur à lui donner

        // Si le champ n'existe pas : on retourne false (sans rien faire)
        if ( ! in_array($nomChamp, $this->champs)) {
            return false;
        }

        // mettre $val dans la valeur du champ : $this->valeurs[$nomChamp]
        $this->valeurs[$nomChamp] = $val;

        // Retourner true
        return true;

    }

    function loadFromtab($tab) {
        // Rôle : Charger les valeurs des champs depuis un tableau (indexé par les noms de champs)
        // Retour : néant
        // Paramètres : 
        //      $tab : tableau contenant des valeurs de champs

        // Pour cahque champ de l'objet
        //      Si on a une valeur pour ce champ dans $tab
        //          on valorise la valeur de ce champ
        foreach($this->champs as $nomChamp) {
            if (isset($tab[$nomChamp])) {
                $this->set($nomChamp, $tab[$nomChamp]);
            }
        }
    }


    function loadById($id) {
        // Rôle : charger l'objet à partir de la ligne ayant un id donné
        // Retour : true si on l'a trouvé, false sinon (ou en cas d'erreur)
        // Paramètres :
        //      $id : id recherché

        // ON commence par vider l'objet
        $this->id = 0;
        $this->valeurs = [];

        // Exécuter la requête de recherche de la bonne ligne
        // Cosntruite la requête et les parmètres associé
        // SELECT `id`, `nomChamp1`, .... FROM `nomTable` WHERE `id` = :id
        // param : [ ":id" => $id ]
        $sql = "SELECT `id` ";
        // Pour chaque champ, on ajoute , nomChamp` à la requête
        foreach($this->champs as $nomChamp) {
            $sql .= ", `$nomChamp`";
        }
        $sql .= " FROM `$this->table` WHERE `id` = :id";

        $param = [ ":id" => $id ];


        // Exécuter la requête
        $req = $this->executeRequest($sql, $param);

        if ($req == false) {
            return false;
        }


        // récupérer les ligne extraites
        $lignes = $req->fetchAll(PDO::FETCH_ASSOC);

        // Si il n'y en pas pas :
        if (empty($lignes)) {
            //      on n'a pa strouvé l'objet
            return false;
        } else {
            // Sinon : on transfère la 1ère ligne récupérée (en principe unique) dans les valeurs des champs et de l'id
            $this->loadFromTab($lignes[0]);      // Valoriser les chammps à partir de la ligne récupérée
            $this->id = $lignes[0]["id"];        // Valoriser l'id à partir de la ligne récupérée
            return true;
        }
    }


    function insert() {
        // Rôle : créer dans la base de données l'objet courant
        // Retour : true si on a réussi, false sinon
        // Paramètres : néant


        // construire la requête SQL (et les parmètres associés)
        // "INSERT INTO table SET nomChapp1 = valeur1, nomChamp2 = valeur2, ....."
        $sql = "INSERT INTO `$this->table` SET ";
        $sql .= $this->makeUpdateInsertChamps(); 

        //print_r($sql);

        // Construction des paramétres;
        $param = $this->makeParamChamps();
        print_r($param);

        // Préparer / excéuter la requête
        $req = $this->executeRequest($sql, $param);

        // Si $req est false : on a echoué
        if ($req == false) {
            $this->id = 0;
            return false;
        }


        // Récuperer l'id crée (et le stocket dans $this->id)
        global $bdd;
        $this->id = $bdd->lastInsertId();
        return true;
    }


    function update() {
        // Rôle: mettre à jour l'objet courant dans la base de données
        // Retour : true si réussi, false sinon
        // Paramètres : néant

        // ON VA FAIRE LA CORRECTION SANS UTIISER LES METHODE DIVERSES CREEE DANS CETTE CLASSE

        // Mettre à jour dans la base :
        // ==========================

            // Construire la requête (texte de la requête) avec les données en paramètres :xxx, construire le tableau de valorisation des paramètres
            // Exemple SQL :
            // UPDATE `contact` SET `nom` = :nom, `prenom` = :prenom, `age` = :age WHERE `id` = :id
            // la tableau des paramètres est donc : [ ":nom" => ...., ":prenom" => ...., ":age" => ..., ":id" => ...]
            // Mais on n'est pas forcément sur des contacts
            // UPDATE `nom de la table` SET `nom champ 1` = :nomChamp1, ....(on répète cela pour chacun des champs)  WHERE `id` = :id
            // nom de la table : on l'a dans $this->table
            // on a les noms des champs dans $this->champs
            // Tableau : [ ":nomChamp1" => valeur1, ...... , ":id" => valeurId ]
            // on a les noms des champs dans $this->champs
            // les valeurs des champs sont dans $this->valeurs
            // La valeur de l'id est dans $this->id
            $sql = "UPDATE `" . $this->table . "` SET ";
            $param = [];                // on faite le tabaleu des paramètres au fure et à mesure que l'on "fabrique" des paramètres

            // On doit maintenant mettre les `nom champ 1` = :nomChamp1 séparés par ds virgules
            // ON va construire un tableau, du type [ "`nom champ 1` = :nomChamp1", "`nom champ 2` = :nomChamp2", .....] (un élément du tabelau par champ de la tableau)
            // ON va "imploser" le tableau en chaine de caractères où les éélments sont separés por des virgules
            $tab = [];      // on part d'un tableau vide
            // Pour chaque champ
            foreach($this->champs as $nomChamp) {
                $tab[] =  " `$nomChamp` = :$nomChamp ";
                // On en profite pour valoriser le paramètre que l'on vient de "créer" : sa valeur $this->valeurs[$nomChamp] 
                // SI la valeur existe : on la met, sinon on met null
                $param[":$nomChamp"] = (isset($this->valeurs[$nomChamp])) ? $this->valeurs[$nomChamp] : null;               
            }
            $sql .= implode(', ', $tab);

            // on ajoute la condition WHERE
            $sql .= " WHERE `id` = :id";
            $param[":id"] = $this->id;          // On valorise e paramètre :id que l'on vient d'utiliser

            // echo "Requête SQL : $sql\n";
            // print_r($param);


            // Préparer la requête (en lui passant la requête)
            global $bdd;
            $req = $bdd->prepare($sql);
            // exécuter la requête préparée en lui npassantle tableau de valeurs des paramètres : ce exécuter nou dit si c'est réussi ou pas 
            $cr = $req->execute($param);


            return $cr;     

    }

    function delete() {
        // Rôle: supprimer l'objet courant de la base de données
        // Retour : true si réussi, false sinon
        // Paramètres : néant


        // Exécuter la réquête de suppression
        // Requête et ses paramètres:
        // DELETE FROM `nomTable`WHERE id = :id
        // paramètres : [ ":id" => valeur de l'id]
        $sql = "DELETE FROM `$this->table` WHERE id = :id";
        $param = [ ":id" => $this->id ];

        $cr = $this->executeRequest($sql, $param);      // ON récupètre une requête exécutée ou false
        // Si ok : mettre id à 0, retourner true
        if ($cr != false) {
            $this->id = 0;
            return true;
        } else {
            // Sinon : retourner false
            return false;
        }


    }

    function getAll() {
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

        // On l'exécute
        $req = $this->executeRequest($sql);

        if ($req == false) {
            // Erreur technique
            return [];
        }
        
        //print_r($req->fetchAll(PDO::FETCH_ASSOC));
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


    function listForSelect($nomChampAffichage, $nomChampTri, $ordre) {
        // Rôle : lister tous les objets de la table, pour un SELECT (liste déroulante en HTML)
        // Retour : tableau [ id => texte à afficher, ..... ]
        // Paramètres :
        //        $nomChampAffichage : nom du champ à afficher
        //        $nomChampTri : nom du champ utilisé pour trier la liste  (par déafut, cad si on ne donne pas ce paramètre, tri ascendant sur nomChampAffichage))
        //        $ordre : ordre de tri   "+" tri ascendant, "-" tri descedant   (+ par défaut)




    }


    function makeUpdateInsertChamps() {
        // Rôle : fabriquer le bout de de requête SQL `nomChamp1` = :valeur1, `nomChamp2` = :valeur2, .....
        // Retour : le texte fabriqué
        // Paramètres : néant

        // ON va fabriquer un tableau dont chaque élément est "`nomChamp1` = :valeur1"
        $tab = [];
        // Pour chacun des champs : crer le bout de sql nomChamp1 = valeur1
        foreach($this->champs as $nomChamp) {
            $tab[] = "`$nomChamp` = :$nomChamp";
        }

        return implode(', ', $tab);
        

    }

    function makeParamChamps() {
        // Rôle : fabriquer le tableau des paramètres pour les champs : [ ":nomChamp1" => valeur1, ... ]
        // Retour : le tableau
        // Paramètres : néant

        // ON va fabriquer un tableau dont chaque élément est ":nomChamp1" => valeur1
        $tab = [];
        // Pour chacun des champs : ajouet l'élément dans $tab
        foreach($this->champs as $nomChamp) {
            // Si la valeurexiste : on la met
            // Sinon : on met null
            if (isset($this->valeurs[$nomChamp])) {
                $tab[":$nomChamp"] = $this->valeurs[$nomChamp];
            } else {
                $tab[":$nomChamp"] = null;
            }
        }

        // On retourne le tableau fabriqué
        return $tab;
     

    }

    function executeRequest($sql, $param = [] ) {           // En écrivant $param = [], on indique que si le deuxième paramètre n'est pas "envoyé", il sera automatiquement valorisé à []
        // Role : prépare et execute une requête sur la BDD
        // Retour : la requête exécutée, false en cas d'échec
        // Paramètres :
        //   $sql : le texte de la requête
        //   $param : le tableau de valorisation des paramètres :xxx

        global $bdd;        // On récupère la BDD ouverte

        // Créer une requête
        $req = $bdd->prepare($sql);

        // Exécuter la requête
        if ( ! $req->execute($param)) {
            // La requête a échoué
            echo "Echec de la requête $sql avec les paramètres : ";
            //print_r($param);
            return false;
        }

        // Cela s'est bien passé : on retourne la requête
        return $req;
    }
        
    function loadByLogin($pseudo) {
        // Rôle : chargement de l'objet courant avec un login donné
        // Retour : true si on a trouvé, false sinon
        // Paramètres :
        //      $login : login recherché
    
        // Vider les valeurs de l'objet et son id
        $this->id = 0;
        $this->valeurs = [];

        // Création de la requête de SELECTION
        // SELECT `id`, `champ1`, `champ2`, ... FROM `table` WHERE `id` = :id 
        // ON crée le début de la requête qui est toujours identique
        $sql = "SELECT `id`";
        // On parcourt la liste des champs
        foreach ($this->champs as $unChamp) {
            $sql .= ", `$unChamp`"; // On fabrique la requête en commençant par la virgule pour ne pas avoir besoin de l'enlever au dernier champ
        }

        // Ajout de la table
        $sql .= "FROM `$this->table` ";
        // Ajout de la condition WHERE
        $sql .= " WHERE `pseudo` = :pseudo";

        $param = [
            ":pseudo" => $pseudo
        ];

        // Exécution de la requête et récupération du résultat
        $req = $this->executeRequest($sql, $param);

        // SI la requête retourne false (donc la requête a échouée)
        if ($req == false) {
            return false;
        }

        // Récupération du informations de la base de données
        // Des lignes de données, dont chaque ligne correspond à tous les champs de la requête avec la valeur associée
        // Ici il n'y aura qu'une seule ligne de récupérer
        $lignes = $req->fetchAll(PDO::FETCH_ASSOC);

        // SI il n'y a rien de récupérer
        if (empty($lignes)) {
            // On retourne false
            return false;
        } else {
            // SINON (si on a récupéré des informations) on charge l'objet courant avec les informations extraites, il n'y a qu'une seule ligne
            $this->loadFromtab($lignes[0]); // Les informations se trouvent à la ligne 0
            $this->id = $lignes[0]["id"]; // On récupère le login
            return true; // On retourne true, tout s'est bien passée
        }

    }

    

}
