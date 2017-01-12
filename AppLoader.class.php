<?php

/**
 * Created by PhpStorm.
 * User: webdev
 * Date: 11/01/17
 * Time: 13:10
 * @name: AppLoader.class.php
 * @author: Webdev | 2016-2017
 * @package: \
 * @version: 1.0
 * @description: Script permettant de charger automatiquement les classes necessaires
 */
class AppLoader
{
    private static $appROOT;

    public function __construct()
    {
        # BEGIN DEBUG
         # echo "Script en cours d'execution : " . $_SERVER['PHP_SELF'] .  "<br />";
        # END DEBUG

            // fonction qui dédinit l'autoloader de classes
        spl_autoload_register(array(__CLASS__, "autoload"));
    }

    /**
     * @name autoload()
     * @param string $className
     * @return bool
     * @throws Exception
     */
    public static function autoload($className)
    {
        self::$appROOT = $_SERVER["DOCUMENT_ROOT"];
        # echo "Chemin => \"" . dirname("/Classes") . "\"<br>";

        // I - On va chercher la classe à partir du dossier Classe de notre application
            // La methode searchClass retourne :
            //  -> le chemin complet de la classe recherché
            //  -> Ou faux si la classe n'a pas pu être trouvée à partir du dossier spécifié
        $fullClassPath = self::searchClass(self::$appROOT . "/Classes/", $className);

        if(!$fullClassPath){
            # echo "En déséspoir de cause, la classe " . $className . " n'a pas été trouvée dans /Classes/, ni dans aucun de ses sous-dossiers <br />";
            # echo "On va donc parcourir le site dans son ensemble... <br />";
            $fullClassPath = self::searchClass(self::$appROOT . "/", $className );
        }

        if($fullClassPath){
            # echo "Ouuuufff... j'ai trouvé " . $className . " et elle se trouve dans " . $fullClassPath . "<br>";
            require_once($fullClassPath);
            return true;
        }

        # echo "La classe " . $className . " n'a pas pu être trouvé ni dans /Classes/, ni à partir de la racine l'application <br>";

        throw new Exception("Impossible de trouver la class " . $className, -1100001);

        return false;
    }


    /**
     * @param $dossier
     * @param $className
     * @return bool|string
     */
    private static function searchClass($dossier, $className)
    {
        # echo "Instancie un iterator avec " . $dossier . " pour chercher " . $className . " à partir de " . $_SERVER['PHP_SELF'] . "<br>" ;

        $listeFichiers = new \DirectoryIterator($dossier);

        foreach ($listeFichiers as $fichier){
            // Ne pas traiter les dossiers (. et ..)
            if($fichier->isDot()){
                # echo "Dans le dossier => " . $dossier . " on a un dossier \".\" ou \"..\"<br />";
                continue;
            }
            if($fichier->isDir()){ // l'objet $fichier de DirectoryIterator est un dossier
                # echo "Le dossier s'appelle => " . $fichier->getFilename() . "<br />";
                if(substr($fichier->getFilename(), 0, 1) == "_"){
                    # echo "Le dossier s'appelle => " . $fichier->getFilename() . " il commence par un \"_\" <br />";
                    continue;
                }
                // Il s'agit d'un dossier, on va entrer dans ce nouveau dossier pour le parcourir à son tour
                if($resultat = self::searchClass($dossier . $fichier->getFilename() . "/", $className)){
                    # echo "C'est donc un dossier, on rappelle la methode searchClass() avec les paramètres " . $dossier .  $fichier->getFilename(). ", " . $className . "<br />";
                    // On a donc trouvé dans ce nouveau dossier ce qu'on cherche...
                    return $resultat;
                } else {
                    continue;
                }
            } else {
                # echo "On traite le fichier => " . $fichier->getFilename() . " on le compare à " . $className . "<br />";
                // Il s'agit donc d'un fichier...
                if($fichier->getFileName() == $className . ".class.php"
                        || $fichier->getFileName() == $className . ".php"
                        || $fichier->getFileName() == "class." . $className . ".php"){
                    // Et il s'agit bien de celui qu'on recherche
                    # echo "C'est le fichier qu'on cherche on le retourne... <br />";
                    return $dossier . $fichier->getFilename();
                }
            }
        }
        # echo "On n'a pas pu trouver le fichier " . $className . "Dans notre application";
        return false; // le fichier demandé n'a pas pu être trouvé...
    }
}