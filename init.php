<?php
if( ! isset($BASE) )  $BASE = './';
require($BASE . 'config_base.php');

session_name( isset($config['cookie']) ? $config['cookie'] : 'clicksound'  );
session_start();

@ini_set('display_errors', 'Off');
// @ini_set('display_errors', 'On');
set_time_limit(0);


if(! isset($BASE)) $BASE = './';

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

/*
 *  HELPERS
 */
include($BASE . '_obj/_misc.php');
include($BASE . '_obj/_orm.php');

$pathhelpers = $BASE . "_lib/helpers/";
$d = dir($pathhelpers);
while (false !== ($entry = $d->read())) {
   $exts = explode('.',$entry);
   if(end($exts) == "php") include($pathhelpers . $entry);
}
$d->close();



if( isset($_GET['getvars']) ) {
    parse_str($_GET['getvars'],$getvars);
    $_GET = array_merge($_GET,$getvars);
}


/*
 *  MODEL.
 */

function model($objecte)
{
    require_once( $GLOBALS['BASE'] . '_obj/'. strtolower($objecte).'.php');
    return new $objecte;
}

function mort($missatge, $codi )
{
    // die($missatge);
    header('Location: /404');
    exit;
}

function r( $codi, $missatge ) {
    header('Location: /index.php');
    exit;
}

function err($valor = true)
{
    ini_set('display_errors', $valor);
}

// de DB a timestamp
function parseData($data) {
    if($data == "1999-11-30 00:00:00"
        or $data == "0000-00-00 00:00:00"
        or $data == "1970-01-01 00:00:00") return null;

    list($dataa, $horaa) = explode(' ',$data);
    list($any,$mes,$dia) = explode('-',$dataa);
    list($hora,$min,$seg) = explode(':',$horaa);
    return mktime((int)$hora,(int)$min,(int)$seg,(int)$mes,(int)$dia,(int)$any);
}

function parseInputTS($data_eng)
{
    list($data,$hora) = explode(' ',$data_eng);
    list($dia,$mes,$any) = explode('/',$data);
    list($hora,$min,$seg) = explode(':',$hora);
    if($hora) return mktime((int)$hora,(int)$min,(int)$seg,(int)$mes,(int)$dia,(int)$any);
    else return mktime(0,0,0,(int)$mes,(int)$dia,(int)$any);
}


function parseAllData( $data_completa ) {
   if($data_completa == "1999-11-30 00:00:00"
        or $data_completa == "0000-00-00 00:00:00"
        or $data_completa == "1970-01-01 00:00:00") return null;


    // data i hora?
    $hora = $data = null;
    $seg = $hora = $min = 0;
    $mes = $dia = $any = 0;

    if( strstr($data_completa," ") ) {
        list($data,$hora) = explode(' ', $data_completa);
    } else {
        $data = $data_completa;
    }

    // hora
    if( $hora ) {
        $parts = explode(':', $hora);
        if( count($parts) == 3 ) list($hora,$min,$seg) = explode(':', $hora, 3);
        if( count($parts) == 2 ) list($hora,$min) = explode(':', $hora, 2);
    }


    // data
    $delimitador = null;
    if( strstr($data,"/") ) $delimitador = '/';
    if( strstr($data,"-") ) $delimitador = '-';
    if( ! $delimitador ) return null;

    $parts = explode($delimitador,$data);
    if( strlen($parts[0]) == 2 ) list($dia,$mes,$any) = explode($delimitador,$data, 3);
    elseif( strlen($parts[0]) == 4 ) list($any,$mes,$dia) = explode($delimitador,$data, 3);


    if($hora) return mktime((int)$hora,(int)$min,(int)$seg,(int)$mes,(int)$dia,(int)$any);
    else return mktime(0,0,0,(int)$mes,(int)$dia,(int)$any);
}


function validaMail($pMail) {
    if (ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@+([_a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$", $pMail ) ) {
       return true;
    } else {
       return false;
    }
}

/* 
 *   IDIOMES
 */ 

function detectarIdioma(){
    //revisamos cabecera HTTP_ACCEPT_LANGUAGE

    $idiomas = explode(";", $_SERVER['HTTP_ACCEPT_LANGUAGE']);
    if(strpos($idiomas[0], "es") !== FALSE){
        $idioma = "esp";
    }
    
    elseif(strpos($idiomas[0], "ca") !== FALSE){
        $idioma = "esp";
    }
     
    elseif(strpos($idiomas[0], "en") !== FALSE){
        $idioma = "eng";
    }

    //Ante cualquier otro idioma devolvemos "es"
    if($idioma <> "esp" && $idioma <> "eng"){
        $idioma = "eng";
    }
    
    
    return $idioma;
}

if( ! isset($_GET['lang'] )) $_GET['lang'] = null;
switch($_GET['lang']):
    case "cat": $lang = 'cat'; break;
    default: 
        /*
        if($_SESSION['lang']) $lang = $_SESSION['lang'];
        else {
            $detectat = detectarIdioma();
            
            if($detectat == "eng") {
                header('Location: ' . $config['base'] . 'eng/');
                exit;
            }
            else {
                $lang = 'esp'; 
            }
            
            $_SESSION['lang'] = $lang;
        }
        */
        $lang = 'esp';
    break;
endswitch;


$GLOBALS['translations'] = array();

include( 'lang/' . $GLOBALS['lang'] . '.php' );

function t($string) {
    $lang = $GLOBALS['lang'];
    $translations = $GLOBALS['translations'][$lang];

    if (! $translations[$string]) return "[" . $string . "]";
    return $translations[$string];
}

function ut($string) {
    return strtoupper(t($string));
}

function et($string) {
    echo t($string);
}

function ct($string) {
    return ucfirst(t($string));
}

function h($string) {
    return htmlspecialchars($string,  ENT_COMPAT,'ISO-8859-1', true);
}



$models = array(
    'modelConfigProjecte'   => model('ConfigProjecte'),
    'modelAnimal'           => model('Animal'),
    'modelAnimalPhoto'     => model('AnimalPhoto')
);


foreach( $models as $n => $m ) $$n = $m;


// $configs = $modelConfigProjecte->loadAll();
// foreach( $configs as $c ):
//     $config['app_' . $c['clau']] = $c['valor'];
// endforeach;

$misc = new misc();
$link = $misc->connectarse();

// $lang = 'esp';
$lcurl = ($lang == 'esp') ? '' : $lang . '/';


$con_cookies = ( isset($_COOKIE['accepto_cookies']) && $_COOKIE['accepto_cookies'] == "true") ? false : true;


$breadcrumb = array();

