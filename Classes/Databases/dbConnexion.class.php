<?php


/**
 * Class dbConnect
 * @name dbConnect.class.php => Définit
 * @project labo-formation-dl.
 * @author Webdev 2016-2017 -> BRUNET Jean-Philippe
 * @package ${FILE_DIRECTORY}
 **/
class dbConnexion {
    /**
     * @var mixed $base => Instance de connexion à une base de données ou Faux, si la connexion a échouée
     */
    private $base;


    public function __construct(){
        $connecteur = dbConfig::$sgbd;
        # echo $connecteur . '<br>';
        $connexion = new $connecteur();
        $connexion->connect();
        $this->base = $connexion->getConnexion();
    }

    /**
     * @return mixed -> Instance de connexion à la BDD ou FAUX
     */
    public function getBase()
    {
        return $this->base;
    }
}