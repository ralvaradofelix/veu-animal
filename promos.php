<?php

	// routing bucle htaccess
	if( $_SERVER['REQUEST_URI'] == "/promos.php" ) {
		header("HTTP/1.1 301 Moved Permanently"); 
		header('Location: /promos/');
		exit;
	}

	// routing bucle htaccess
	if( $_SERVER['REQUEST_URI'] == "/promos" ) {
		header("HTTP/1.1 301 Moved Permanently"); 
		header('Location: /promos/');
		exit;
	}

	// routing bucle htaccess
	if( $_SERVER['REQUEST_URI'] == "/cat/promos" ) {
		header("HTTP/1.1 301 Moved Permanently"); 
		header('Location: /cat/promos/');
		exit;
	} 
	$BASE = './';
	include($BASE . 'init.php');

	$url_cat = '/cat/promos/';
	$url_esp = '/promos/';
	
	// ----------- template

	$url = parse_url($_SERVER['REQUEST_URI']);
	$url = array('url' => $url['path'] );
	$meta = $modelMetas->loadByFields($url);
	if( ! $meta ):
		$modelMetas->save( $url );
	else:
		if($meta['title']) $meta_title = $meta['title'];
		if($meta['description']) $meta_description = $meta['description'];
		if($meta['keywords']) $meta_keywords = $meta['keywords'];
	endif;
	

	
	$banners = $modelProductePromocio->loadAll("posicio ASC");
	

	$productes = $modelProducte->loadAllQuery("SELECT * FROM producte 
												WHERE (( promocio_id != '' AND promocio_id != '0' AND promocio_id IS NOT NULL ) OR en_promocio = '1' )
												AND es_desactivat = '0' 
												ORDER BY posicio ASC ");
	foreach( $productes as $k => $producte ):
		$productes[$k] = $modelProducte->loadFromArray($producte);
	endforeach;


	$pageTitle = $meta['title'] ? $meta['title'] : ct('promociones');
	if( ! $breadcrumb ) $breadcrumb[ $pageTitle ] = $_SERVER['REQUEST_URI'];

	$active = "promociones";
	$body_class="page--promos";
	include('_header.php');
?>
		<main id="swup" class="main" role="main">

			<?php include('_breadcrumb.php'); ?>

			<div class="transition-fade">

				<h1 class="main__title transition-move"><?= $pageTitle ?></h1>
		

				<div class="gird grid_container">

						<?php
						foreach( $productes as  $producte ):
							$estat = $producte_estats_db[ $producte['estat_id'] ];
							$marca = $marques_db[ $producte['marca_id'] ];

							$galeria = $modelProducteGaleria->loadAllByFields(array('producte_id' => $producte['id'] ), 'posicio ASC');
							$rel_categories = $modelProducteCategoria->loadAllByFields(array('producte_id' => $producte['id'] ), 'id ASC' );

							$promocio = $producte['promocio_id'] ? $modelProductePromocio->load( $producte['promocio_id'] ) : array();


							$url = $config['base'] . $lcurl . 'producto/';
							$ultima_categoria_rel = end( $rel_categories );
							$url .= $categories_db[ $ultima_categoria_rel['categoria_id'] ]['curl'] . '/' . HelpString::curl( $marca['nom'] ) . '-' . HelpString::curl( $producte['referencia']  );

							// include de la card
							include('_card_producte.php');

						endforeach;


						?>

 
						<?php
						/*  
						foreach( $banners as $banner ):
							 

							$curl = HelpString::curl( $banner['nom_' . $lang ] );
							?>
							<div class="card card--noticia">
								<a href="<?= $config['base'] . 'productos/ocasion-' . HelpString::curl($banner['nom_' . $lang ]) . '/'  ?>">
									<div class="card__media">
										<img class="media-image" src="<?= $config['base'] . '_var/producte_promocio/' . $banner['id'] . '-foto-' . $banner['foto'] ?>" alt="">
									</div>
								</a>
								<div class="card__header">
									<a href="<?= $config['base'] . 'productos/ocasion-' . HelpString::curl($banner['nom_' . $lang ]) . '/'  ?>">
									<h2 class="title-noticia"><?= $banner['nom_' . $lang ] ?></h2>
									</a>
								</div>
								<div class="card__text">
									<p><?= $banner['descripcio_' . $lang ] ?></p>
								</div>

							</div>
						<?php 
						$p++;
						endforeach; 
						*/

						?>

					</div>

				</div>
				
			</main>
		<?php include('_footer.php'); ?>
	</body>
</html>
