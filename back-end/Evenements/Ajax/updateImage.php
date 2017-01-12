<?php
/**
 * Created by PhpStorm.
 * User: BRUNET Jean-Philippe
 * Date: 06/01/2017
 * Time: 13:56
 */


// récuperation du paramètre transmis en "GET" Dans la requête HTTP
$id = $_GET['id'];

// A partir de ce moment là on va exécuter un select sur cette valeur d'identifiant dans la table evenements
$event =  new evenements();
$event->selectByID($id);

$img = $event->events['illustration'];

// Supprimer le fichier physiquement sur le serveur
$fullPathName = dirname(__FILE__) . "..". $img;

if(@unlink($fullPathName)){
    $result["fileDeletion"] = 1; // On ajoute une clé indiquant que le fichier a bien été supprimé
} else {
    $result["fileDeletion"] = 0; // La clé indiquera que la suppression n'a pu être effectuée
}

// Dans tous les cas on met a jour la BDD
$updateStatus = $event->updateImage($id);

// Initialise le tableau qui sera retransmis à la callback "success" de l'appel Ajax
$results = array(
    "statut" => $updateStatus ? 1 : 0
);

$results['id'] = $id;

header("Cache-Control: no-cahe, must-revalidate");
header("Expires: Mon, 26 Jul 1997 03:00:00 GMT");
header("Content-type: application/json");

echo json_encode($results);

// Ajoute la clé "id" dans le résultat JSON renvoyé