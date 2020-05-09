<?php
/**
 * Helper Timmer
 */
class HelpTimmer
{
    /**
     *
     * @param Integer $timestamp segons que obtenim de les restes o d'on sigui.
     * @return Integer[] array('days' => Integer, 'hours' => Integer, 'minuts' => Integer, 'seconds' => Integer);
     */
    public static function toHumanArray($timestamp) {
        $return = array('years' => 0,'months' => 0, 'days' => 0, 'hours' => 0, 'minuts' => 0, 'seconds' => 0);

        # Obtenemos el numero de dias
	$years=floor((($timestamp/60)/60)/24/30/12);
	if($years>0) {
            $timestamp -= $years * 24 * 60 * 60 * 30 * 12;
            $return['years'] = $years;
	}
        
	# Obtenemos el numero de dias
	$months=floor((($timestamp/60)/60)/24/30);
	if($months>0) {
            $timestamp -= $months * 24 * 60 * 60 * 30;
            $return['months'] = $months;
	}

        # Obtenemos el numero de dias
	$days=floor((($timestamp/60)/60)/24);
	if($days>0) {
            $timestamp-=$days*24*60*60;
            $return['days'] = $days;
	}

	# Obtenemos el numero de horas
	$hours=floor(($timestamp/60)/60);
	if($hours>0) {
            $timestamp-=$hours*60*60;
            $return['hours'] = $hours;
	}

	# Obtenemos el numero de minutos
	$minutes=floor($timestamp/60);
	if($minutes>0) {
            $timestamp-=$minutes*60;
            $return['minuts'] = $minutes;
	}

        $return['seconds'] = $timestamp;
        
	return $return;
    }

    /**
     *
     * @param Integer $timestamp de la resta time() - created_at
     * @param String $level default: 1, correspon als valors tornats
     *    level 1:   1 day
     *    level 2:   1 day 3 hours  // TODO
     *    level 3:   1 day 3 hours 5 minuts   // TODO
     */
    public static function toHuman($timestamp,$level = 1) {
        $array = self::toHumanArray($timestamp);
        if($level == 1) {
            if($array['years'] > 0) return $array['years'] . " year" . (($array['years'] > 1) ? 's' : '');
            if($array['months'] > 0) return $array['months'] . " month" . (($array['months'] > 1) ? 's' : '');
            if($array['days'] > 0) return $array['days'] . " day" . (($array['days'] > 1) ? 's' : '');
            if($array['hours'] > 0) return $array['hours'] . " hour" . (($array['hours'] > 1) ? 's' : '');
            if($array['minuts'] > 0) return $array['minuts'] . " minut" . (($array['minuts'] > 1) ? 's' : '');
            if($array['seconds'] > 0) return $array['seconds'] . " second" . (($array['seconds'] > 1) ? 's' : '');
        }
    }

}

