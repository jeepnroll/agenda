<?php
/**
 * @name controller .php.
 * @project Initiation.
 * User: BRUNET Jean-Philippe
 * Date: 21/12/2016 à 11:36
 * @description => Controller d'affichage du module agenda
 **/
require_once('Classes/_Evenements/EvenementPrive.class.php');
require_once('Classes/_Evenements/EvenementPublic.class.php');
require_once('Classes/_Evenements/Agenda.class.php');
/**
 * Instanciation des objets
 **/
$agendaPublic = new Agenda();
$agendaPrive = new Agenda();

$aucard = new EvenementPublic();
$aucard->titre = "Festival Aucard de Tours";
$aucard->idEvent = "aucard";
$aucard->dateDebut("26/06/2017");
$aucard->dateFin("30/06/2017");
$aucard->heureDebut("20H00");
$aucard->heureFin("22h00");
$aucard->lieu = "<adress><strong>Plaine de la Gloriette</strong> <br/> 37000 Tours</adress>";
$aucard->description = "<p>Festival éclectique en plain air pendant 4 jours à Tours</p>";
$aucard->description .= "<p>25 Groupes en concert, 3 scènes, 12 buvettes</p>";
$aucard->maxPlacesDisponibles(5000);
$aucard->photo("http://www.unjenesaisquoi.org/sites/default/files/slider/1472750_563172310426825_1079783466_n.jpg");
$aucard->titrePhoto("Affiche du festoche");
// ajoute $aucard événement à la collection d'évènements.
$agendaPublic->addEvent($aucard);

$tds = new EvenementPublic();
$tds->titre = "Festival Terre Du Son";
$tds->idEvent = "tds";
$tds->dateDebut("28/07/2017");
$tds->dateFin("01/08/2017");
$tds->heureDebut("20H00");
$tds->heureFin("22h00");
$tds->lieu = "<adress><strong>Château de Cangé</strong> <br/> 37550</adress>";
$tds->description = "<p>Festival éclectique en plain air pendant 4 jours à Tours</p>";
$tds->description .= "<p>25 Groupes en concert, 3 scènes, 12 buvettes</p>";
$tds->maxPlacesDisponibles(12000);
$tds->photo("http://t0.gstatic.com/images?q=tbn:ANd9GcTC6UA3oYowW5ctqpoZsq9gm9bvc9shVrpYlqrliSw0luw0mA3BVUJQ55E");
$tds->titrePhoto("Affiche du festoche");
// ajoute $tds événement à la collection d'évènements.
$agendaPublic->addEvent($tds);


$agAsso = new EvenementPrive();
$agAsso->titre  = "Assemblée générale de la Saut'Mouton";
$agAsso->bureau = "Tous les membres";
$agAsso->idEvent = "ag2017";
$agAsso->dateDebut("25/01/2017");
$agAsso->heureDebut("18h00");
$agAsso->dateFin("25/01/2017");
$agAsso->heureFin("21h00");
$agAsso->ordreDuJour = "<h2>Defriefing de l'année 2016</h2>";
$agAsso->ordreDuJour .= "<h4>Les événéments passés</h4>";
$agAsso->ordreDuJour .= "<ul>";
$agAsso->ordreDuJour .= "<li>Lorem ipsum dolor sit amet.</li>";
$agAsso->ordreDuJour .= "<li>Lorem ipsum dolor sit amet.</li>";
$agAsso->ordreDuJour .= "<li>Lorem ipsum dolor sit amet.</li>";
$agAsso->ordreDuJour .= "<li>Lorem ipsum dolor sit amet.</li>";
$agAsso->ordreDuJour .= "</ul>";
$agAsso->ordreDuJour .= "<h4>Les Compte de l'année</h4>";
$agAsso->ordreDuJour .= "<ul>";
$agAsso->ordreDuJour .= "<li>Lorem ipsum dolor sit amet.</li>";
$agAsso->ordreDuJour .= "<li>Lorem ipsum dolor sit amet.</li>";
$agAsso->ordreDuJour .= "<li>Lorem ipsum dolor sit amet.</li>";
$agAsso->ordreDuJour .= "<li>Lorem ipsum dolor sit amet.</li>";
$agAsso->ordreDuJour .= "</ul>";
$agAsso->ordreDuJour .= "<h4>Les événéments prévus</h4>";
$agAsso->ordreDuJour .= "<ul>";
$agAsso->ordreDuJour .= "<li>Lorem ipsum dolor sit amet.</li>";
$agAsso->ordreDuJour .= "<li>Lorem ipsum dolor sit amet.</li>";
$agAsso->ordreDuJour .= "<li>Lorem ipsum dolor sit amet.</li>";
$agAsso->ordreDuJour .= "<li>Lorem ipsum dolor sit amet.</li>";
$agAsso->ordreDuJour .= "</ul>";

$agendaPrive->addEvent($agAsso);

if($_GET["vue"])
{
    if($_GET["vue"] == "public"){
        include "Vues/public.php";
    } elseif ($_GET["vue"] == "prive"){
        include "Vues/dashboard.php";
    } elseif ($_GET["vue"] == "all"){
        include "Vues/all.php";
    }
} else {

    include "Vues/public.php";
}

