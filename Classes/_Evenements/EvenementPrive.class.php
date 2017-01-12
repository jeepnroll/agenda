<?php

require_once "DefinitionEvenement.class.php";
/**
 * Class EvenementPrive
 * @name EvenementPrive.class.php
 * @project Initiation.
 * @author Webdev 2016-2017 -> BRUNET Jean-Philippe
 * @version 1.0
 * @package Initiation/Agenda/Modele
 * @description => Détérmine les spécificités des événements Privés
 **/

class EvenementPrive extends DefinitionEvenement
{

    public $bureau;
    public $ordreDuJour;

    /**
     * EvenementPrive constructor.
     */
    public function __construct()
    {

    }

}