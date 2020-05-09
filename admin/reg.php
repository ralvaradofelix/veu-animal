<?php

$usuari = isset($_SESSION['usuari']) ? $_SESSION['usuari'] : null;
$contrasenya = isset($_SESSION['contrasenya']) ? $_SESSION['contrasenya'] : null;

$usr = isset($GLOBALS['config']['user']) ? $GLOBALS['config']['user'] : null;
$pwd = isset($GLOBALS['config']['pwd']) ? $GLOBALS['config']['pwd'] : null;
 
if(! empty($_COOKIE['usuari']) )
{
	list($usuari,$contrasenya) = explode('-',$_COOKIE['usuari']);
	if($usuari == $usr && $contrasenya == $pwd) 
	{
		$_SESSION['admin'] = array('nom_complet'=>'Administrador', 'email' => $usr, 'contrasenya'=> md5($pwd));
	}
	else
	{
		header('Location: login.php');
	}
} 
else if( isset($_SESSION['admin']['email']) && isset($_SESSION['admin']['contrasenya']) && $_SESSION['admin']['email'] == $usr && $_SESSION['admin']['contrasenya'] == md5($pwd) )
{
	setcookie('usuari',$_SESSION['admin']['email'] . '-' . $_SESSION['admin']['email'],time()+60*60*12);
} 
else header('Location: login.php');


?>