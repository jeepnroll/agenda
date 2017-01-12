<?php

/**
 * @name DefinitionEvenement .class.php.
 * @project Initiation.
 * User: BRUNET Jean-Philippe
 * Date: 21/12/2016 à 11:37
 * @description => Défini les attributs
 **/
abstract class DefinitionEvenement
{
    protected $dateDebut;
    protected $dateFin;
    protected $heureDebut;
    protected $heureFin;
    public $idEvent;
    public $titre;
    public $description;


    /**
     * @name dateDebut($dateDebut = null)
     * @param optional null $dateDebut
     * @return  mixed DefinitionEvenement | \DateTime
     * @description => getter et setter de $datedebut
     *      => permet de verifier si la date de début est bien inférieur à la date de fin
     *      => permet le chaînage de méthode
     */
    public function dateDebut($dateDebut = null)
    {
        if(!is_null($dateDebut)){

                $this->dateDebut = $dateDebut;

        } else {
            return $this->dateDebut;
        }
         return $this;
    }

    /**
     * @name dateFin($dateFin)
     * @param $dateFin
     * @return mixed DefinitionEvenement | \DateTime
     * @description => getter et setter de $dateFin
     *      => permet de verifier si la date de fin est bien supérieur à la date de début
     *      => permet le chaînage de méthode
     */
    public function dateFin($dateFin = null)
    {
        if(!is_null($dateFin)){

                $this->dateFin = $dateFin;

        } else {
            return $this->dateFin;
        }
        return $this;
    }

    /**
     * @name heureDebut($heure = null):\DateTime
     * @param null $heure
     * @return mixed DefinitionEvemenement | \DateTime
     * @description => getter et setter de $heureDebut
     *      => permet de verifier si l'heure de fin est bien supérieur à l'heure de début
     *      => permet le chaînage de méthode
     */
    public function heureDebut($heure = null)
    {
        if(!is_null($heure)){

                $this->heureDebut = $heure;

        }else{
            return $this->heureDebut;
        }
        return $this;
    }

    /**
     * @name heureFin($heure = null):\DateTime
     * @param null $heure
     * @return mixed DefinitionEvemenement | \DateTime
     * @description => getter et setter de $heureFin
     *      => permet de verifier si l'heure de fin est bien supérieur à l'heure de début
     *      => permet le chaînage de méthode
     */
    public function heureFin($heure = null)
    {
        if(!is_null($heure)){

                $this->heureFin = $heure;

        }else{
            return $this->heureFin;
        }
        return $this;
    }

    public function render(){
        $event = $this; // Ca commence mal, pourquoi stocker dans une variable, moi-même, objet... en plus dans la Mamie's classe

    }
}