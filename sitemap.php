<?php
include('init.php');

$urls = array();
$urls_txt = array();

// home

$langs = array('esp','cat');

$urls = array();

$urls['esp'] = array();
$urls['cat'] = array();



// marques

$urls[] = $urls['esp'][] = "Páginas";
$urls[] = $urls['cat'][] = "Pàgines";



$urls[] = $urls['esp'][] = array( $config['base'] => 'Cargol Caravanas' );
$urls[] = $urls['cat'][] = array( $config['base'] . 'cat/' => 'Cargol Caravanes' );


// $urls[] = $urls['esp'][] = array($config['base'] . 'clientes-satisfechos' => 'Clients Satisfechos');
// $urls[] = $urls['cat'][] = array($config['base'] . 'cat/clientes-satisfechos' => 'Clients Satisfets');

$urls[] = $urls['esp'][] = array($config['base'] . 'contacto/' => 'Contacto');
$urls[] = $urls['cat'][] = array($config['base'] . 'cat/contacte/' => 'Contacte');

$urls[] = $urls['esp'][] = array($config['base'] . 'financiacion/' => 'Financiación');
$urls[] = $urls['cat'][] = array($config['base'] . 'cat/financament/' => 'Finançament');

$urls[] = $urls['esp'][] = array($config['base'] . 'promos/' => 'Promociones');
$urls[] = $urls['cat'][] = array($config['base'] . 'cat/promos/' => 'Promocions');

// marques

$urls[] = $urls['esp'][] = "Marcas";
$urls[] = $urls['cat'][] = "Marques";


$marques = $modelProducteMarca->loadAll('posicio ASC, id ASC');
foreach( $marques as $marca ):
	if( $marca['slug'] ):
		$urls[] = $urls['esp'][] = array(  $config['base'] . $marca['slug'] => 'Marca: ' . $marca['nom'] );
		$urls[] = $urls['cat'][] = array(  $config['base'] . 'cat/' . $marca['slug'] => 'Marca: ' . $marca['nom'] );
	endif;
endforeach;


$urls[] = $urls['esp'][] = "Categorias";
$urls[] = $urls['cat'][] = "Categories";

$categories_principals = $modelCategoria->loadAllByFields(array('categoria_id' => 0),"posicio asc, id asc" );

foreach( $categories_principals as $cat_principal ):

	$urls[] = $urls['esp'][] = array( $config['base'] . 'productos/' . $categories_db[ $cat_principal['id'] ]['curl'] . '/' => $cat_principal['nom_esp'] );
	$urls[] = $urls['cat'][] = array( $config['base'] . 'cat/' . 'productos/' . $categories_db[ $cat_principal['id'] ]['curl'] . '/' => $cat_principal['nom_cat'] );

	$categories_submenu = $modelCategoria->loadAllByFields(array('categoria_id' => $cat_principal['id']),"posicio asc, id asc" );
	foreach( $categories_submenu as $cat ):
		 
		$urls[] = $urls['esp'][] = array( $config['base'] . 'productos/' . $categories_db[ $cat['id'] ]['curl'] . '/' => $cat_principal['nom_esp'] . ' / ' . $cat['nom_esp'] );
		$urls[] = $urls['cat'][] = array( $config['base'] . 'cat/' . 'productos/' . $categories_db[ $cat['id'] ]['curl'] . '/' => $cat_principal['nom_cat'] . ' / ' .  $cat['nom_cat'] );

	endforeach;
endforeach;


$urls[] = $urls['esp'][] = "Ocasiones";
$urls[] = $urls['cat'][] = "Ocasions";


$banners_promos = $modelProductePromocio->loadAllByWhere(" foto != '' ", "posicio ASC");
foreach( $banners_promos as $promo ):
	$urls[] = $urls['esp'][] = array( $config['base'] . 'productos/ocasion-' . HelpString::curl($promo['nom_esp']) . '/'  => 'Ocasiones ' . $promo['nom_esp'] );
	$urls[] = $urls['cat'][] = array( $config['base'] . 'cat/productos/ocasio-' . HelpString::curl($promo['nom_cat']) . '/'  => 'Ocasions ' . $promo['nom_cat'] );
endforeach;


$urls[] = $urls['esp'][] = "Productos";
$urls[] = $urls['cat'][] = "Productes";

// productes
 
$objs = $modelProducte->loadAllByWhere( ' 1 = 1 ', 'posicio ASC, id ASC' );
foreach( $objs as $obj ):
    $producte = $obj;
    $marca = $obj['marca_id'] ? $modelProducteMarca->load( $obj['marca_id'] ) : null;
    $rel_categories = $modelProducteCategoria->loadAllByFields(array('producte_id' => $producte['id'] ), 'id ASC' );
    $url = $config['base'] . $lcurl . 'producto/';
    $ultima_categoria_rel = end( $rel_categories );
    $url .= $categories_db[ $ultima_categoria_rel['categoria_id'] ]['curl'] . '/' . HelpString::curl( $marca['nom'] ) . '-' . HelpString::curl( $producte['referencia']  );

    $urls[] = $urls['esp'][] = array( $url => $marca['nom'] . ' ' . $obj['referencia'] );
	$urls[] = $urls['cat'][] = array( $url => $marca['nom'] . ' ' . $obj['referencia'] );


endforeach;

// noticies

$urls[] = $urls['esp'][] = "Noticias";
$urls[] = $urls['cat'][] = "Noticies";


$noticies = $modelNoticia->loadAll("data DESC");
$urls[] = $urls['esp'][] = array( $config['base'] . 'noticias/' => 'Notícias' );
$urls[] = $urls['cat'][] = array( $config['base'] . 'cat/noticies/' => 'Noticies' );
foreach( $noticies as $noticia ):
	foreach( $langs as $lang ):
		$curl = HelpString::curl( $noticia['nom_' . $lang ] );
		$urls[] = $urls[ $lang ][] = array( $config['base'] . ( $lang == 'esp' ? '' : $lang . '/') . 'noticia/' . $curl => $noticia['nom_' . $lang ]  );
	endforeach;
	
endforeach;




function save_map( $urls ) {

	$buffer_txt = "";

	foreach( $urls as $url_array ):
		if( is_array($url_array) ):
			foreach( $url_array as $url => $title ):
				$buffer_txt .= $url . "\r\n";
			endforeach;
		else:
			// $buffer_txt .= "\r\n# " . $url_array . "\r\n"; 
		endif;
	endforeach;
	
	file_put_contents('sitemap.txt', $buffer_txt, FILE_APPEND);
}



function show( $urls ) {

	?>
	<ul>
	<?php

	foreach( $urls as $url_array ):
		if( is_array($url_array) ):
			foreach( $url_array as $url => $title ):
				?><li><a href="<?= $url ?>" target="_blank"><strong><?= $url ?></strong></a> &middot; <?= $title ?></li><?php
			endforeach;
		else:
			?><h1><?= $url_array ?></h1><?php
		endif;
	endforeach;
	?></ul><?php

	save_map( $urls );
}


file_put_contents('sitemap.txt', "");

show( $urls['esp'] );
echo '<hr />';
show( $urls['cat'] );

echo '<pre>EOF</pre>';