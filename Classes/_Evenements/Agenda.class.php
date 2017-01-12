<?php

/**
 * Class Agenda
 * @name Agenda .class.php
 * @project Initiation.
 * @author Webdev 2016-2017 -> BRUNET Jean-Philippe
 * @package Initiation/Agenda/Modele
 * @namespace Agenda\Modele
 * @description => Détérmine les spécificités des événements Privés
 **/
class Agenda
{
    protected $vue;
    protected $evenements = array();


    public function getEvents()
    {
        return $this->evenements;
    }

    public function addEvent($event)
    {
        if(is_object($event)){
            $this->evenements[] = $event;
        }
        return $this; // La méthode va retourner l'instance de l'objet concerné
    }

    public function getPublicEvent()
    {
        return $this->evenements;
    }

}