<?php
/**
 * Helper de File
 */
class HelpFile
{
    var $mime_types = array(
        'txt' => 'text/plain',
        'htm' => 'text/html',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'swf' => 'application/x-shockwave-flash',
        'flv' => 'video/x-flv',

        // images
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'ico' => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif' => 'image/tiff',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',

        // archives
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'exe' => 'application/x-msdownload',
        'msi' => 'application/x-msdownload',
        'cab' => 'application/vnd.ms-cab-compressed',

        // audio/video
        'mp3' => 'audio/mpeg',
        'qt' => 'video/quicktime',
        'mov' => 'video/quicktime',

        // adobe
        'pdf' => 'application/pdf',
        'psd' => 'image/vnd.adobe.photoshop',
        'ai' => 'application/postscript',
        'eps' => 'application/postscript',
        'ps' => 'application/postscript',

        // ms office
        'ppt' => 'application/vnd.ms-powerpoint',
        'doc' => 'application/msword',
        'rtf' => 'application/rtf',
        'xls' => 'application/vnd.ms-excel',


        // open office
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    );

    public static function getMimeType($pathfile) {
        $parts_ruta = explode(".",$pathfile);
        $extensio = $parts_ruta[count($parts_ruta)-1];
        return $this->mime_types[$extensio];
    }


    /**
     * Agafa un document parteix les seves paraules i les retorna a un array.
     * Serveix per despr√©s recorre-ho i saber quantes paraules i quines contenen
     * per exemple: *.html o quants "<a" hi ha al document.
     */
    
    public static function paraules($fitxer) {
        $paraules = array();
        $contingut = file_get_contents($fitxer);
        $linies = explode("\n",$contingut);
        foreach($linies as $line) {
            $line = trim($line);
            $ps = explode(" ",$line);
            foreach($ps as $p) $paraules[] = $p;
        }
        
        return $paraules;
    }


    public static function size($file) {
        $bytes = filesize($file);
        if ($bytes < 1024) return $bytes.' B';
       elseif ($bytes < 1048576) return round($bytes / 1024, 2).' KB';
       elseif ($bytes < 1073741824) return round($bytes / 1048576, 2).' MB';
       elseif ($bytes < 1099511627776) return round($bytes / 1073741824, 2).' GB';
       else return round($bytes / 1099511627776, 2).' TB';

    }


   // Another simple way to recursively delete a directory that is not empty:
   public static function rrmdir($dir) {
       if (is_dir($dir)) {
         $objects = scandir($dir);
         foreach ($objects as $object) {
           if ($object != "." && $object != "..") {
             if (filetype($dir."/".$object) == "dir") self::rrmdir($dir."/".$object); else unlink($dir."/".$object);
           }
         }
         reset($objects);
         rmdir($dir);
        }
   }
   
   
   public static function excelToArray($file) {
        // Require PHPExcel
        $objReader = PHPExcel_IOFactory::createReaderForFile($file);
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($file);
        $objWorksheet = $objPHPExcel->getActiveSheet();

        $highestRow = $objWorksheet->getHighestRow(); // e.g. 10
        $highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5


        $lines = array();
        for ($row = 1; $row <= $highestRow; ++$row):
            $line = array();
            for( $col = 0; $col < $highestColumnIndex; $col++ ):
                $line[$col - 1] = trim($objWorksheet->getCellByColumnAndRow($col, $row)->getValue());
            endfor; // column
            $lines[] = $line;
        endfor; // row
        
        return $lines;
   }

   
   public static function resize($file_input, $file_output, $w_o, $h_o, $percent = false) {
            list($w_i, $h_i, $type) = getimagesize($file_input);
            if (!$w_i || !$h_i) {
                    echo 'No podemos obtener la resoluciÛn de la im·gen original';
                    return;
            }
            $types = array('','gif','jpeg','png');
            $ext = $types[$type];
            if ($ext) {
                    $func = 'imagecreatefrom'.$ext;
                    $img = $func($file_input);
            } else {
                    echo 'Tipo de archivo incorrecto';
                    return;
            }
            if ($percent) {
                    $w_o *= $w_i / 100;
                    $h_o *= $h_i / 100;
            }
            
            if (!$h_o) $h_o = $w_o/($w_i/$h_i);
            if (!$w_o) $w_o = $h_o/($h_i/$w_i);

            $img_o = imagecreatetruecolor($w_o, $h_o);
            imagecopyresampled($img_o, $img, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i);
            if ($type == 2) {
                    return imagejpeg($img_o,$file_output,100);
            } else {
                    $func = 'image'.$ext;
                    return $func($img_o,$file_output);
            }
    }
    
    
    public static function crop($file_input, $file_output, $crop = 'square',$percent = false) {
            list($w_i, $h_i, $type) = getimagesize($file_input);
            if (!$w_i || !$h_i) {
                    echo 'No podemos obtener la resoluciÛn de la im·gen original';
                    return;
            }
            $types = array('','gif','jpeg','png');
            $ext = $types[$type];
            if ($ext) {
                    $func = 'imagecreatefrom'.$ext;
                    $img = $func($file_input);
            } else {
                    echo 'Tipo de archivo incorrecto';
                    return;
            }
            if ($crop == 'square') {
                    $min = $w_i;
                    if ($w_i > $h_i) $min = $h_i;
                    $w_o = $h_o = $min;
            } else {
                    list($x_o, $y_o, $w_o, $h_o) = $crop;
                    if ($percent) {
                            $w_o *= $w_i / 100;
                            $h_o *= $h_i / 100;
                            $x_o *= $w_i / 100;
                            $y_o *= $h_i / 100;
                    }
                    if ($w_o < 0) $w_o += $w_i;
                    $w_o -= $x_o;
                    if ($h_o < 0) $h_o += $h_i;
                    $h_o -= $y_o;
            }
            $img_o = imagecreatetruecolor($w_o, $h_o);
            imagecopy($img_o, $img, 0, 0, $x_o, $y_o, $w_o, $h_o);
            if ($type == 2) {
                    return imagejpeg($img_o,$file_output,100);
            } else {
                    $func = 'image'.$ext;
                    return $func($img_o,$file_output);
            }
    }


   
   
}

