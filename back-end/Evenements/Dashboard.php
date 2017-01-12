<?php
// echo "<pre class='debug'><code>";
/**
 * @name controller.php => Contrôleur du back-end CRUD sur la table evenements
 * @user BRUNET Jean-Philippe
 * @author webdev - Déc. 2016
 * @package Agenda/back-end/_Evenements
 * @version 1.0
 * @see Intranet/Civilite/civiliteController.php
 **/
//function mime_content_type($filename){
//    $result = new \finfo();
//
//    if(is_resource($result) === true){
//        return $result->file($filename, FILEINFO_MIME_TYPE);
//    }
//    return false;
//}
ini_set("display_errors", true);
error_reporting(E_ALL);
/**
 * 1. Importer les classes nécessaires pour le fonctionnement du contrôleur
 **/
require_once (dirname(__FILE__) . "/../../AppLoader.class.php");
$apploader = new AppLoader();

/*
if(file_exists("Modele/evenements.class.php"))
    require("Modele/evenements.class.php");
else
    echo "le fichier : Modele/evenements.class.php n'a pas été trouvé" . $_SERVER['PHP_SELF'];// ORM Faisant la relation entre le back-end et la table evenement

if(file_exists("../../Modele/Helper/DateHelper.class.php"))
    require("../../Modele/Helper/DateHelper.class.php");
else
    echo "le fichier : DateHelper.class.php n'a pas été trouvé" . $_SERVER['PHP_SELF'];

*/

/**
 * INSTANCIATION D'UN NOUVEL OBJET
 */
$evenement = new evenements();

#BEGIN DEBUG
//$evenement->select();
//echo "<pre><code>";
//
//var_dump($event->events);
//echo "</pre></code>";
#END DEBUG
/**
 * 2. Savoir si des données ont été postées et agir en conséquence : Ajouter ou Modifier l'information
 **/

/**
 * 2-2 On va contrôler si des informations on été transmises dans $_POST
 */
if(sizeof($_POST)){
    #var_dump($_POST);
    $evenement->save($_POST);
}
#var_dump($_POST);

/**
 * 3. Inspecter les données de la requête HTTP ($_GET) pour savoir ce que vous avez à faire :
 *	- Afficher la liste des événements de votre base de données
 *	- ou Supprimer un événement dont vous connaîtrez l'id
 *	- Afficher le formulaire d'ajout d'un événement
 *	- Afficher le formulaire de mise à jour d'un événement
 **/

#var_dump($_GET);
if(sizeof($_GET) == 0) {
    $evenement->select();
    $vue = "listeEvent.php";
    $page_titre = "Tous les événements";
}else{
    if(isset($_GET["id"])){
        $evenement->selectByID($_GET["id"]);
        $vue = "formulaireEvent.php";
        $page_titre = "Mettre à jour";
        $btnLabel = "Mettre à jour";
        $iClass = "<i class=\"fa fa-pencil fa-2x\"></i>";
        $maj = $_GET['titre'];

    }elseif (isset($_GET['context']) == "addEvent"){
        $vue = "formulaireEvent.php";
        $page_titre = "Ajouter un événement";
        $btnLabel = "Ajouter";
    }
}
// echo "</code></pre>";
/**
 * 4. Charger la vue correspondante à ce qui a été défini à l'étape 3
 **/
include("_vues/" . $vue);