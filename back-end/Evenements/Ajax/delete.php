<?php
/**
 * Created by PhpStorm.
 * User: BRUNET Jean-Philippe
 * Date: 03/01/2017
 * Time: 14:16
 * @name delete.php
 * @info => script appelé en Ajax pemettant la suppression d'un événement
 */

$id = $_POST["id"];

// On devrait procéder au traitement lui-même...
require_once('../Modele/evenements.class.php');
$event = new evenements();
$result = $event->delete($id);

// Prépare l'information à retourner au script jQuery
$resultat = array(
    "statut" => $result ? 1 : 0,
    "row" => "row_" . $id
);
//$resultat = array(
//    "statut" => 1,
//    "row" => "row_3"
//);
// on renvoie la ligne qu'on veux supprimer

$json = json_encode($resultat);
$error = json_last_error();
header("Cache-Control: no-cahe, must-revalidate");
header("Expires: Mon, 26 Jul 1997 03:00:00 GMT");
header("Content-type: application/json");

echo $json;
#var_dump($json, $error) ;


