<?php

/**
 * Class Connexion
 * @name Connexion .class.php => Définit la manière de se connecter à une base de données
 * @project Initiation.
 * @author Webdev 2016-2017 -> BRUNET Jean-Philippe
 * @package /Objet/Initiation/Class/Databases
 **/
abstract class Connexion {

    /**
     * @var $host -> URL de la BDD
     */
    protected $host;
    /**
     * @var $port -> port à utiliser pour se connecter à la BDD
     */
    protected $port;
    /**
     * @var $userName -> Identifiant de connexion à la BDD
     */
    protected $userName;
    /**
     * @var $password -> Mot de passe de connexion à la BDD
     */
    protected $password;
    /**
     * @var $dbName -> Nom de la BDD
     */
    protected $dbName;
    /**
     * @var $statut bool
     */
    private $statut;
    /**
     * @var
     */
    private $connexion;

    /**
     * @name getStatut -> Vérifie le statut de la connexion à la BDD
     * @return bool|PDO
     */
    public function getStatut(){
        return $this->statut;
    }

    protected function setStatut($statut){
        $this->statut = $statut;
    }

    protected function setConnexion($connexion){
        $this->connexion = $connexion;
    }

    public function getConnexion(){
        if($this->statut){
            return $this->connexion;
        }
    }

    public function isLocal(){
        if($_SERVER["SERVER_NAME"] == "localhost" || $_SERVER["SERVER_NAME"] == "127.0.0.1"){
            return true;
        }
        return false;
    }
    /**
     * Définition d'une méthode abstraite, sans corps ({})
     *	pour obliger à coder cette méthode dans les classes filles
     **/
    abstract public function connect();
}