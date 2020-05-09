<?php
 
	include('init.php');

 	$url = $_SERVER['REQUEST_URI'];

 	
 	$es_ocasion = strstr($url,"ocasio") ? true : false;
 	$es_cat = strstr($url,"/cat/");
 	$es_esp =  strstr($url,"/es/");



	$marques_db = array();
	$items = $modelProducteMarca->loadAll("posicio ASC");
	foreach( $items as $c  ) $marques_db[ $c['id'] ] = $c;

  	$marca = null;
	foreach( $marques_db as $marca ):
		if( '/' . $marca['slug'] == $url ):
			  
			$init_included = true;
			$_GET['marca_id'] = $marca['id'];

			include('expositor.php');
			exit;

		endif;
	endforeach;




	// Creem redireccions

 	header("HTTP/1.1 301 Moved Permanently");


 	if( $es_cat ) {

		 	if( strstr($url,"/caravanas") or strstr($url,"/caravanes")  ) {

		 		if( $es_ocasion ) {
		 			header('Location: /cat/productos/caravanes-ocasio/');
		 			exit;
		 		} else {
		 			header('Location: /cat/productos/caravanes/');
		 			exit;
		 		}

		 	} else if( strstr($url,"/autocaravanas") or strstr($url,"/autocaravanes") ) {
				if( $es_ocasion ) {
		 			header('Location: /cat/productos/autocaravanes-ocasio/');
		 			exit;
		 		} else {
		 			header('Location: /cat/productos/autocaravanes/');
		 			exit;
		 		}
		 	}

 	} 


 	if( strstr($url,"/caravanas") ) {
 		if( $es_ocasion ) {
 			header('Location: /productos/caravanas-ocasion/');
 			exit;
 		} else {
 			header('Location: /productos/caravanas/');
 			exit;
 		}
 	} else if( strstr($url,"/autocaravanas") ) {
		if( $es_ocasion ) {
 			header('Location: /productos/autocaravanas-ocasion/');
 			exit;
 		} else {
 			header('Location: /productos/autocaravanas/');
 			exit;
 		}
 	}



	if( strstr($url,"/caravanes") ) {
 		if( $es_ocasion ) {
 			header('Location: /productos/caravanes-ocasio/');
 			exit;
 		} else {
 			header('Location: /productos/caravanes/');
 			exit;
 		}
 	} else if( strstr($url,"/autocaravanes") ) {
		if( $es_ocasion ) {
 			header('Location: /productos/autocaravanes-ocasio/');
 			exit;
 		} else {
 			header('Location: /productos/autocaravanes/');
 			exit;
 		}
 	}


 
die('not routing');

?>