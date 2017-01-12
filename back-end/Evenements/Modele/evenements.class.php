<?php

/**
 * @name evenements.class.php Services de relation entre le contrôleur et la table evenements de la base de données
 * @author webdev - Déc. 2016
 * @package Agenda/back-end/_Evenements/modele
 * @version 1.0
 *	- Une méthode permettant de lister tous les événements : select()
 *	- Une méthode permettant de ne récupérer que l'événement par son identifiant : selectById()
 *	- Une méthode pour dispatcher la mise à jour : save()
 *	- Une méthode privée pour l'insertion : add()
 *	- Une méthode privée pour la mise à jour : update()
 * @see Intranet/Modele/civilite.class.php
 **/
class evenements extends ModeleORM
{
    public $events ;
    private $postedDatas;
    private $colonnes;


    public function __construct()
    {
        // Créer un tableau avec le nom des colonnes de la table concernée
        $this->colonnes = array(
            "event_id",
            "type",
            "date_debut",
            "date_fin",
            "heure_debut",
            "heure_fin",
            "titre",
            "description",
            "programme",
            "lieu",
            "illustration",
            "photo_titre",
            "places_disponibles",
            "ordre_du_jour",
            "commission"
        );
        $this->primaryKeyName = "event_ID";
        $this->tableName = "authentification.evenement";
        $this->events = array();
    }


    /**
     * @param string $nomAttribut
     * @return string
     */
    public function __get($nomAttribut){
        if(in_array($nomAttribut, $this->colonnes)){
            return sizeof($this->events) ? $this->events[$nomAttribut] : "";
        }

        return false;
    }

    /**
     * @name select()
     */
    public function select()
    {
        // La variable $select contiendra la requête SQL "SELECT ... FROM ..." à executer
        $select = "SELECT ". $this->primaryKeyName . "," ;
        // la fonction implode() assemble les éléments d'un tableau en les séparant par une chaîne
        // et retourne une chaîne de caractères.
        $select .= implode(",", $this->colonnes);
        $select .= " FROM " . $this->tableName . " ORDER BY " . $this->primaryKeyName . ";";
        #BEGIN DEBUG
//            $debug = "<pre><code>Chaîne de requête : <br>";
//            $debug .= $select;
//            $debug .= "</code></pre>";
//            echo $debug;
//            die("Je suis dans la methode select()...");
        #END DEBUG

        $connexion = new dbConnexion();
        $base = $connexion->getBase();
        # var_dump($base);
        if(!is_null($base)){
            $resultat = $base->query($select);
            # echo 'la requete est executee';
            if($resultat !== false){
                # echo 'la requete est executee';
                // parcourt le jeu de résultat en créant un objet à chaque ligne parcourue
                $resultat->setFetchMode(PDO::FETCH_OBJ);
                // Boucle sur chaque ligne de résultats, et on stocke la valeur dans l'objet $ligne
                while($ligne = $resultat->fetch()){
                    $event = array();
                    // Stocke la valeur de l'identifiant de l'événement
                    $event['event_id'] = $ligne->{$this->primaryKeyName};
                    foreach ($this->colonnes as $colonne){
                        $event[$colonne] = $ligne->{$colonne};
                    }
                    // Ajoute la ligne dans le tableau final
                    $this->events[] = $event;
                }
            }
        }
    }

    /**
     * @param int $eventID
     */
    public function selectByID($eventID)
    {
        if($eventID > 0){
            // Crée la requête de sélection d'un seul enregistrement (une seule liqne
            // à partir de la valeur d'un identifiant($eventID)
            $select = "SELECT " . $this->primaryKeyName . ",";
            $select .= implode(",", $this->colonnes);
            $select .= " FROM " . $this->tableName;
            // Ajoute la contrainte : clé-primaire = paramètre $id transmis
            $select .= " WHERE " . $this->primaryKeyName . "=" . $eventID . ";";
            #BEGIN DEBUG
//            $debug = "<pre><code>Chaîne de requête : <br>";
//            $debug .= $select;
//            $debug .= "</code></pre>";
//            echo $debug;
            # die("Je suis dans la methode selectByID()...");
            #END DEBUG

            $connexion = new dbConnexion();
            $base = $connexion->getBase();
            if(!is_null($base)){
                // On a bien une instance de PDO de connexion à la base de données
                // On peut donc exécuter la requête (Méthode PDO::query()) et récupérer le jeu de résultats dans la variable $resultats
                $resultat = $base->query($select);

                // Vérifie si $resultats est différent de faux ($resultats est faux si la requête n'a pas pu être exécutée)
                if($resultat !== false){
                    $resultat->setFetchMode(PDO::FETCH_OBJ);// Parcourt le jeu de résultat en créant un objet à chaque ligne parcourue
                    // Une seule ligne ne peut être retournée par cette requête... ou aucune
                    $ligne = $resultat->fetch();
                    if($ligne !== false){
                        // La méthode "fetch()" a bien retourné la ligne correspondante à l'id ($eventID)
                        $this->events['event_id'] = $ligne->{$this->primaryKeyName};
                        // Alimente le reste d'un tableau
                        foreach($this->colonnes as $colonne){
                            if ($colonne == "date_debut" || $colonne == "date_fin"){
                                $this->events[$colonne] = $ligne->{$colonne};
                            } else {
                                $this->events[$colonne] = $ligne->{$colonne};
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * @param $postedDatas
     * @return mixed
     */
    private function insert($postedDatas)
    {
        $connexion = new dbConnexion();
        $base = $connexion->getBase();

        if(!is_null($base)){
            // La connexion étant établie avec le serveur de BDD, on peut créer la requête d'insertion
            $insert = "INSERT INTO " . $this->tableName . "(";

            // Ca ne peut pas fonctionner...
            // l'ordre dans $this->colonnes est différent de l'ordre des clés  de $postedDatas
            // $insert.= implode(",",$this->colonnes) . ") VALUES (" ;

            // array_keys retourne un tableau ne contenant que les clés d'un tableau associatif
            $colonnes = array_keys($postedDatas);
            # BEGIN DEBUG
            #var_dump($colonnes);
            # END DEBUG
            // array_pop dépile une ligne à la fin du tableau, en le raccourcissant d'une ligne
            array_pop($colonnes);
            // Supprimer MAX_FILE_SIZE des colonnes à traiter
            $cols = array();
            for ($i = 0; $i < sizeof($colonnes); $i++){
                if($colonnes[$i] != "MAX_FILE_SIZE"){
                    $cols[] = $colonnes[$i];
                }
            }
            $colonnes = $cols;
            unset($postedDatas["MAX_FILE_SIZE"]); // Enlève la clé MAX_FILE_SIZE Des données postées
            # BEGIN DEBUG
            var_dump($colonnes);
            # END DEBUG

            $insert.= implode(",", $colonnes);
            // ajouter les champs : images et programmes
            $insert.= ",illustration,programme) VALUES (";

            // Boucle sur les données postées, pour alimenter la requête INSERT
            foreach ($postedDatas as $colName => $colValue){
                if($colName != "event_id"){
                    if($colName == "date_debut" || $colName == "date_fin"){
                        $insert.= $base->quote(DateHelper::toUsDate($colValue, $colValue)) . ",";
                    }else{
                        if($colName == "places_disponibles"){
                            if($colValue == ""){
                                $insert .= "0,";
                            } else {
                                $insert .= (int) $colValue . ","; // Casting de variable: force $colValue à être converit en un entier
                            }
                        } else{
                            $insert.= $base->quote($colValue) . ",";
                        }
                    }
                }
            }

            // on supprime la virgule en trop
            $insert = substr($insert,0,strlen($insert) - 1) . ",";

            // traiter les champs spécifiques : images et programmes
            require_once ('../../Modele/File/UploadFile.class.php');
            $upload = new UploadFile("illustration");
            $upload->addMime("image");

            $uploadFilePath = $upload->process();

            if(is_null($uploadFilePath)){
                // Ca veut dire que l'upload n'a pas réussi ...
                $insert .= "'',";
            } else {
                // Ca veut dire que l'upload a bien été effectuer
                $insert .= $base->quote($uploadFilePath). ",";
            }

            $upload = new UploadFile("programme");
            $upload->addMime("application/pdf");

            $uploadFilePath = $upload->process();

            if(is_null($uploadFilePath)){
                // Ca veut dire que l'upload n'a pas réussi ...
                $insert .= "'',";
            } else {
                // Ca veut dire que l'upload a bien été effectuer
                $insert .= $base->quote($uploadFilePath) ;
            }
            $insert .= ");";
            # BEGIN DEBUG
//            $debug = "";
//            $debug.= "<pre><code class='text-white'>";
//            $debug.= "<h4>La requête </h4>";
//            $debug.= "<p>" . $insert . "</p>";
//            $debug.= "</code></pre>";
//            echo $debug;
//            die();
            # END DEBUG
            $resultat = $base->exec($insert);
            return $resultat;
        }
    }

    /**
     * retourne le tableau d'évènement avec un ligne vide
     */
    public function emptyEvent()
    {
        // la clé primaire est vide aussi
        $this->events["envent_id"] = "";
        foreach ($this->colonnes as $colonne){
            $this->events[$colonne] = "";
        }
    }

    private function update($postedDatas){
        $connexion = new dbConnexion();
        $base = $connexion->getBase();

        if(!is_null($base)){
            $update = "UPDATE " . $this->tableName . " SET ";

            foreach ($postedDatas as $colName => $colValue){
                if($colName != "event_id"){

                    if($colName == "date_debut" || $colName == "date_fin"){
                        $update .= $colName ." = " . $base->quote(DateHelper::toUsDate($colValue, $colValue)) . ",";
                    } else {
                        $update .= $colName . " = " .  $base->quote($colValue) . ",";
                    }
                }
            }
            $update .= substr($update,0,strlen($update)-1);
            $update .= " WHERE " . $this->primaryKeyName . " = " . $postedDatas['event_id'] . ";";

            # BEGIN DEBUG
//            $debug = "<pre><code>";
//            $debug.= "<h3>Requête de mise à jour :</h3>";
//            $debug.= "<p>" . $update . "</p>";
//            $debug.="</code></pre>";
//            echo $debug;
            # END DEBUG

            $resultat = $base->exec($update);

            return $resultat;
        }
        return false;
    }


    /**
     * Dispatcher de requête : ajout ou modification en fonction du contexte
     * @param $postedDatas : données postées depuis le formulaire <=> $_POST
     **/
    public function save($postedDatas = null){
        if(array_key_exists("event_id", $postedDatas)){
            if($postedDatas['event_id'] != ""){
                // Une valeur de clé primaire a été transmise... donc, mise à jour
                $this->update($postedDatas);
            } else {
                $this->insert($postedDatas);
            }
        }
    }


    /**
     * Met à jour la colonne image de la table evenement sur l'ID evenement_id transmis en paramètre
     **/
    public function updateImage($id){
        $result = false; // On considère par défaut que la requête va échouer

        $update = "UPDATE " . $this->tableName . " SET illustration='', photo_titre='' WHERE " . $this->primaryKeyName . "=" . $id . ";";
        // echo "<pre><code>" . $update . "</code></pre>";
        $connexion = new dbConnexion();
        $base = $connexion->getBase(); // $base est un objet de type PDO

        if(!is_null($base)){
            $result = $base->exec($update);
        }

        return $result;
    }

}