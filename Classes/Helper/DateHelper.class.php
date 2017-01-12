<?php

/**
 * Created by PhpStorm.
 * User: BRUNET Jean-Philippe
 * Date: 02/01/2017
 * Time: 13:29
 */
class DateHelper
{
    /**
     * @var array $mois => stocke les mois en français
     */
    public static $mois = array(
        "Janvier",
        "Février",
        "Mars",
        "Avril",
        "Mai",
        "Juin",
        "Juillet",
        "Août",
        "Septembre",
        "Octobre",
        "Novembre",
        "Décempbre"
    );

    /**
     * Public => accessible de n'importe quel endroit (monde exterieur)
     * static => La méthode est appeller sans avoir besoin d'instancier un objet au préalable (dateHelper::toFrDate())
     * final => elle ne pourra donc pas être surchargée dans une eventuelle classe fille
     * Convertit une date au format US (AAAA-MM-JJ) vers un format FR (JJ-MM-AAAA)
     * @var string $strDate : chaîne contenant une date au format US
     * @var $moisEnClair => transforme le N° de mois en mois en lettre
     * @var string $formatter : format de la chaîne à sortir
     * @return string $oDate => date au format Fr
     */
    public static final function toFrDate($strDate, $moisEnClair = "", $formatter = "d-m-Y")
    {
        // Utiliser la classe interne DateTime pour créer un objet de type DateTime
        $oDate = new DateTime($strDate);

        $mois = $oDate->format('n');
        $indice = $mois - 1 ; // Un tableau, ça part toujours de 0
        $moisEnClair = self::$mois[$indice];

        if($moisEnClair !== false){
            return $oDate->format('d'). " " . $moisEnClair . " " . $oDate->format("Y");
        }
        return $oDate->format($formatter);
    }

    public static final function toUsDate($strDate, $format = "d-m-Y"){
        $oDate = DateTime::createFromFormat($format, $strDate);
        if($oDate !== false){
            return $oDate->format("Y-m-d");
        }
        // Si jamais $oDate est faux...
        if(strpos($strDate, "-") !== false){
            $oDate = DateTime::createFromFormat($strDate, "d-m-Y") ;
        }elseif (strpos($strDate, "/") !== false){
            $oDate = DateTime::createFromFormat($strDate, "d/m/Y") ;
        }
        return $oDate->format("Y-m-d");
    }


}