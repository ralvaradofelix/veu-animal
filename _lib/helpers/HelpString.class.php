<?php
/**
 * Helper String
 */
class HelpString
{

    // random key
    public static function random($len = 8) {
        $claves = array_flip(array_merge(range('A','Z'),range(0,9)));
        return implode("",array_rand($claves, $len)); 
    }

    public static function eliminaAccents($string) {
        /*
        $accents = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
        $accents_replace = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
        return strtr(str_replace(" ","-",strtolower($string)),$accents,$accents_replace);
        */
        $string = str_replace(" ","-",strtolower($string));
        $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ'; 
        $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr'; 
        $string = utf8_decode($string);     
        $string = strtr($string, utf8_decode($a), $b); 
        $string = strtolower($string);
        return utf8_encode($string); 
    }
    
    public static function curl( $string  ) {
        $string = self::eliminaAccents($string); // triem accents
        // $string = trim(preg_replace('<\W+>', "-", $string), "-");
        
        // per finalitzar
        $string = strtolower( str_replace(' ','-',$string) );

        return $string;
         
    }

    public static function fileCurl( $string ) {
      $parts = explode('.', $string);
      $ext = array_pop($parts);

      $base = HelpString::curl( implode(".", $parts) );

      return $base .'.' . $ext;
    }


    public static function caracters_especials($str) {
        $str = ereg_replace( chr(146), "'", $str );     # spostruf
        $str = ereg_replace( chr(147), "\"", $str );    # cometes
        $str = ereg_replace( chr(148), "\"", $str );    # cometes
        $str = ereg_replace( chr(149), "&#8226;", $str );    # dieresi gran
        $str = ereg_replace( chr(150), "&ndash;", $str );    # guio llarg
        $str = ereg_replace( chr(151), "&mdash;", $str );    # guio llarg

        $str = ereg_replace( chr(153), "&#8482;", $str );   # trademark
        $str = ereg_replace( chr(169), "&copy;", $str );    # copyright mark
        $str = ereg_replace( chr(174), "&reg;", $str );     # registration mark
        return $str;
    }

    
    public static function tallaLink($link,$len = 20,$class = null,$target = null) {
        $href = $link;
        if(strlen($link) > $len) {
            $link = substr($link, 0, $len) . '...';
        }

        return '<a href="'.$href.'" class="'.$class.'" title='.$href.' target="'.$target.'">'.$link.'</a>';
    }



    public function Unicode_to_UTF( $input, $array=TRUE){

         $utf = '';
        if(!is_array($input)){
           $input     = str_replace('&#', '', $input);
           $input     = explode(';', $input);
           $len = count($input);
           unset($input[$len-1]);
        }
        for($i=0; $i < count($input); $i++){

        if ( $input[$i] <128 ){
           $byte1 = $input[$i];
           $utf  .= chr($byte1);
        }
        if ( $input[$i] >=128 && $input[$i] <=2047 ){

           $byte1 = 192 + (int)($input[$i] / 64);
           $byte2 = 128 + ($input[$i] % 64);
           $utf  .= chr($byte1).chr($byte2);
        }
        if ( $input[$i] >=2048 && $input[$i] <=65535){

           $byte1 = 224 + (int)($input[$i] / 4096);
           $byte2 = 128 + ((int)($input[$i] / 64) % 64);
           $byte3 = 128 + ($input[$i] % 64);

           $utf  .= chr($byte1).chr($byte2).chr($byte3);
        }
        if ( $input[$i] >=65536 && $input[$i] <=2097151){

           $byte1 = 240 + (int)($input[$i] / 262144);
           $byte2 = 128 + ((int)($input[$i] / 4096) % 64);
           $byte3 = 128 + ((int)($input[$i] / 64) % 64);
           $byte4 = 128 + ($input[$i] % 64);
           $utf  .= chr($byte1).chr($byte2).chr($byte3).
    chr($byte4);
        }
        if ( $input[$i] >=2097152 && $input[$i] <=67108863){

           $byte1 = 248 + (int)($input[$i] / 16777216);
           $byte2 = 128 + ((int)($input[$i] / 262144) % 64);
           $byte3 = 128 + ((int)($input[$i] / 4096) % 64);
           $byte4 = 128 + ((int)($input[$i] / 64) % 64);
           $byte5 = 128 + ($input[$i] % 64);
           $utf  .= chr($byte1).chr($byte2).chr($byte3).
    chr($byte4).chr($byte5);
        }
        if ( $input[$i] >=67108864 && $input[$i] <=2147483647){

           $byte1 = 252 + ($input[$i] / 1073741824);
           $byte2 = 128 + (($input[$i] / 16777216) % 64);
           $byte3 = 128 + (($input[$i] / 262144) % 64);
           $byte4 = 128 + (($input[$i] / 4096) % 64);
           $byte5 = 128 + (($input[$i] / 64) % 64);
           $byte6 = 128 + ($input[$i] % 64);
           $utf  .= chr($byte1).chr($byte2).chr($byte3).
    chr($byte4).chr($byte5).chr($byte6);
        }
       }
       return $utf;
    }


    public static function tallaText($string, $len = 255, $striptags = true, $suspensius = '...') {
        $string = htmlspecialchars_decode($string);
        if($striptags) $string = strip_tags($string);

        if(count(explode('<br />',wordwrap($string,$len,'<br />'))) > 1)
            return current(explode('<br />',wordwrap($string,$len,'<br />'))) . $suspensius;
        else
            return $string;
    }


    static public function slugify($string)
    {
      // replace non letter or digits by -
      // $string = transliterator_transliterate("Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();", $string);

      $string = trim(preg_replace('<\W+>', "-", $string), "-");

      return $string;
    }


}

