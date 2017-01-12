<?php

/**
 * Class MySQL
 * @name MySQL .class.php => Permet de tester les connexions à une base de données MySQL
 * @project Initiation.
 * @author Webdev 2016-2017 => BRUNET Jean-Philippe
 * @package /Objet/Initiation/Class/Databases
 **/
class MySQL extends Connexion {
     /**
     * @var string $msgError => conserve les message et exception de la connexion.
     */
     private $msgError;

    /**
     * MySQL constructor -> Permet d'insérer les différents paramètres de connexion à la BDD dans un objet
     * @param $host : adresse de la BDD
     * @param int $port : port d'ecoute de la BDD
     * @param $userName : Nom de l'utilisateur autorisé a se connecter à la BDD
     * @param $password : Mot de passe de l'utilisateur pour se connecter à la BDD
     * @param $dbName : Nom de la base de données à la quelle se connecter
     */
    public function __construct($host=null, $port=null, $userName=null, $password=null, $dbName=null)
    {
        $this->host = is_null($host) ? dbConfig::$host : $host;
        $this->port = is_null($port) ? dbConfig::$port : $port;
        $this->userName = is_null($userName) ? dbConfig::getUser() : $userName;
        $this->password = is_null($password) ? dbConfig::getPassword() : $password;
        $this->dbName = is_null($dbName) ? dbConfig::getDBName() : $dbName;
    }

    public function setPort($port){
        $this->port = $port;
    }

    /**
     * @name connect -> permet de tester la connexion et renvoie les erreurs
     * @return bool -> Statut de la connexion VRAI ou FAUX
     */
    public function connect(){
        $options = array();
        try {
            $connexion = new PDO($this->getDSN(), $this->userName, $this->password, $options);
        } catch (Exception $e){
            $msgError = "<div class='alert alert-danger alert-dismissible' role='alert'>";
            $msgError .= "Message => <strong>" . $e->getMessage() ." [" . $e->getCode() . "]</strong>";
            $msgError .= "</div>";
            $this->msgError = $msgError;
            $this->setStatut(false);
            // echo $msgError;
            // die("test");
            return false;
        }
        $this->setStatut(true);
        $this->setConnexion($connexion);
        return true;
    }

    /**
     * @name getDSN -> renvoie le dsn de connexion à la BDD
     * @return PDO object
     */
    private function getDSN(){
        return $this->creerDSN();
    }

    /**
     * @name setDSN -> Permet de créer l'objet PDO avec la chaîne de paramètre de connexion à la BDD
     * @return PDO -> objet de connexion
     */
    private function creerDSN(){
        return "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbName ;
    }
}