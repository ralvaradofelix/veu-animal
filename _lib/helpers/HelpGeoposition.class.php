<?php
/*
 * Helpers Geoposition
 *
 */

class HelpGeoposition
{
   /**
    * Retorna la distancia entre dos posicions GPS en linia recta.
    * Serveix per fer una cerca de radi X metres
    * @param String $pos_ini "1.4809098,2.393909" [lat,lon]
    * @param String $pos_fi "1.4809098,2.393909" [lat,lon]
    * @return Integer metros de distancia
    */
   public static function distance($pos_ini,$pos_fi){
        list($lat1,$lon1) = explode(",",$pos_ini,2);
        list($lat2,$lon2) = explode(",",$pos_fi,2);

        $result = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc('
        SELECT (acos(sin(radians('.$lat1.')) * sin(radians('.$lat2.')) +
                        cos(radians('.$lat1.')) * cos(radians('.$lat2.')) *
                        cos(radians('.$lon1.') - radians('.$lon2.'))) * 6378) as
                        distancia');
        $results = current($result);
        return $results['distancia']*1000;
    }

}

