<?php

require_once "DefinitionEvenement.class.php";
/**
 * @Class EvenementPublic
 * @name EvenementPublic.class.php
 * @project Initiation.
 * @author Webdev 2016-2017 -> BRUNET Jean-Philippe
 * @package Initiation/Agenda/Modele
 * @namespace Agenda\Modele\jeep;
 * @description => Détermine les spécificités des évenements publics
 **/

class EvenementPublic extends DefinitionEvenement
{
    public $lieu;
    protected $maxPlacesDisponibles;
    protected $photo; // stocke l'url de la photo à afficher
    protected $titrePhoto;


    /**
     * @name placesDisponibles($nbPlaces = null)
     * @param optional null int $nbPlaces
     * @return $this
     * @description => Sert de getter et de setter a l'attribut $maxPlacesDisponibles
     *              => Vérifie si $nbPlaces est bien un entier.
     */
    public function maxPlacesDisponibles($nbPlaces = null){
        // Getter de $maxPlacesDisponibles
        if(is_null($nbPlaces)){
            return $this->maxPlacesDisponibles;
        }
        // Setter de maxPlacesDisponibles
        if(is_int($nbPlaces)){
            $this->maxPlacesDisponibles = $nbPlaces;
        }
        return $this;
    }

    public function photo($urlPhoto = null)
    {
        if (is_null($urlPhoto)){
            return $this->photo;
        }
        $this->photo = $urlPhoto;
        return $this;
    }

    public function titrePhoto($titrePhoto = null)
    {
        if (is_null($titrePhoto)){
            return $this->titrePhoto;
        }
        $this->titrePhoto = $titrePhoto;
        return $this;
    }
}