<?php

	if(  ! isset( $init_included)  ):
		$BASE = './';
		include($BASE . 'init.php');
	endif;

	$curl = isset($_GET['curl']) ? $_GET['curl'] : array();
	$promo = null;

	$where = array("es_desactivat = '0'");

	// base de dades
	$promos_bd = array();
	$promos = $modelProductePromocio->loadAll();
	foreach( $promos as $promo_db ):
		$promos_bd[ HelpString::curl( $promo_db['nom_' . $lang ] ) ] = $promo_db;
	endforeach;


	$cat_filtre_id = array();

	$categoria_principal = null;
	$categories = array();

	if( $curl ): // tenim una categoria ?

 		// busquem curl sense passar per base de dades (evitem SQL injection)
		foreach( $categories_db as $c ): 
			if( $c['curl'] == $curl ):

				$cat_filtre_id = $c['id'];
				$categoria_principal = ($c['categoria_id']) ? $modelCategoria->load( $c['categoria_id'] ) : $c;
				// if($c['categoria_id']) $cats_ids[] = $c['categoria_id'];
				$categoria_pare = ($c['categoria_id']) ? $modelCategoria->load( $c['categoria_id'] ) : null;

				$where[] = " id IN ( SELECT producte_id FROM " . $modelProducteCategoria->taula . " WHERE categoria_id = '" . $cat_filtre_id . "' ) ";
				
				// pageTitle and breadcrumb
				if( $categoria_pare ){ 
					$categories[] = $categoria_pare;

					$pageTitle = $categoria_pare['nom_' . $lang ] . ' ' . $c['nom_' . $lang];
					$breadcrumb[ $categoria_pare['nom_' . $lang ] ] = $config['base'] . $lcurl . 'productos/' . $categoria_pare['curl_' . $lang] . '/';
				} else {
					$pageTitle = $c['nom_' . $lang ];
				}

				$categoria_slug = $c;
				$meta_description = $c['meta_' . $lang] ? $c['meta_' . $lang] : t('exposicio_descripcio') . ' ' . $pageTitle;

				$categories[] = $c;
				$breadcrumb[ $pageTitle ] = $_SERVER['REQUEST_URI'];

				break; // el tenim, fem break
			endif;
		endforeach;

	endif; // ens passen una categoria
 


	if( strstr($curl,"ocasio-") ) {
		$token = str_replace("ocasio-","", $curl );
		if( isset($promos_bd[ $token ])) {
			$where[] = "promocio_id = '" . $promos_bd[ $token ]['id'] . "' ";
			$promo = $modelProductePromocio->load( $promos_bd[ $token ]['id'] );
		}

		$pageTitle = 'Ocasi&oacute; ' . $promos_bd[ $token ]['nom_' . $lang];
		$meta_description = "Exposici&oacute; de caravanes i autocaravanes d'ocasi&oacute;: " . $promos_bd[ $token ]['nom_' . $lang];	
	}



	if( strstr($curl,"ocasion-") ) {
		$token = str_replace("ocasion-","", $curl );
		if( isset($promos_bd[ $token ])) {
			$where[] = "promocio_id = '" . $promos_bd[ $token ]['id'] . "' ";
			$promo = $modelProductePromocio->load( $promos_bd[ $token ]['id'] );
		}	
		

		$pageTitle = 'Ocasi&oacute;n ' . $promos_bd[ $token ]['nom_' . $lang];	
		$meta_description = "Exposici&oacute;n de caravanas y autocaravanas de ocasi&oacute;n: " . $promos_bd[ $token ]['nom_' . $lang];
	}


	
	// ve del index.php
	$marca_id = ( isset($_GET['marca_id']) && is_numeric($_GET['marca_id']) ) ? $_GET['marca_id'] : null;
	if( $marca_id ) {
		
		$where[] = " marca_id = '" . $marca_id . "' ";

		$title_parts = explode('-', $curl);
		$title_parts = array_map("ucfirst", $title_parts);
		$pageTitle = implode(" ", $title_parts);

		$meta_description = t('exposicio_descripcio') . ' ' . $pageTitle;

		$marca_description = t('exposicio_descripcio') . ' ' . $pageTitle;
		if( $marques_db[ $marca_id ]['descripcio_' . $lang ] ) $marca_description = $marques_db[ $marca_id ]['descripcio_' . $lang ];
	}

	// $noticies = $modelNoticia->loadAllByFields(array('actiu' => '1'),"data DESC");
	// $productes = $modelProducte->loadAll("posicio ASC");
	$productes = $modelProducte->loadAllByWhere( "( " . implode(" ) AND ( ", $where ) . " )", "posicio ASC, id ASC");


	// estem mirant caravanes o autocaravanes?


	
	if( $productes ): 
		$first = $productes[0];
		$cats_ids = array();
		foreach( $categories_principals as $c ):
			$cats_ids[] = $c['id'];
		endforeach;
		 
		$where = array(' categoria_id IN (' . implode(',', $cats_ids) . ') ', 'producte_id = "'  . $first['id'] .  '" ');
		$rel = $modelProducteCategoria->loadAllByWhere( implode("  AND  ", $where ) , "posicio ASC, id ASC");
		$categoria_principal = $categories_db[ $rel[0]['categoria_id'] ];
	endif;
 

 	$banners_promos = $modelProductePromocio->loadAllByWhere(" foto != '' ", "posicio ASC");



	// ----------- template
	$meta_title = $pageTitle;
	

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
	
	if( ! $breadcrumb ) $breadcrumb[$pageTitle] = $_SERVER['REQUEST_URI'];

	 
	$actiu = isset($categories[0]) ? $categories[0]['curl_' . $lang] : null;
	$actiu_submenu = isset($categories[1]) ? $categories[1]['curl'] : null;
	

	$body_class="page_expositor";
	include('_header.php');
?>

<style type="text/css">
.ahora_no { padding: 20px 10px; text-align: center; line-height: 15px; }
</style>
		<main id="swup" class="main" role="main">
			<?php include('_breadcrumb.php'); ?>

			<?php if( empty($promo) ): ?>
				<h1 class="main__title transition-move"><?= $pageTitle ?></h1>
				<!-- <h4 class="transition-fade"><strong>Cargol Caravanas</strong> dispone de una amplia gama de Autocaravanas y caravanas nuevas de las principales marcas: Challenger, Rapido, Caravelair, Silver...<br />
				Consulta nuestro catálogo y <a href="<?= $config['base'] . $lcurl ?>contacto">contacta con nosotros</a> si tienes alguna duda, <strong>¡tu nueva autocaravana te está esperando!</strong></h4> -->
				 
				<h4 class="transition-fade">
					<p><?= (! empty($categoria_slug['descripcio_' . $lang]) ) ? $categoria_slug['descripcio_' . $lang] : ( !empty($marca_description) ? $marca_description : $meta_description ); ?></p>
				</h4>

			<?php else: // es promocio ?>
				<h1 class="main__title transition-move"><?= $promo['nom_' . $lang ] ?></h1>
				<?php if($promo['slogan_' . $lang ]): ?>
				<h4 class="transition-fade"><?= $promo['slogan_' . $lang ] ?></h4>
				<?php endif; ?>
				<h4 class="transition-fade"><?= $promo['descripcio_' . $lang ] ?></h4>
			<?php endif; ?>


				<div class="dialog-tab transition">
					<a href="<?= $config['base'] . $lcurl ?>promos" class="dialog-tab__trigger button button_theme_yellow">
					<?= ct('promociones') ?>
					</a>
				</div>

			<div class="grid grid_container transition-fade">	
						<?php

						if( ! $productes ) {
							?>
								<div class="card card--product transition-move" data-id="<?= $producte['id'] ?>">
									
									<p>Ahora no tenemos <?= $pageTitle ?>, puedes encontrar otras opciones en:</p>
									 <a href="<?= $config['base'] . 'productos/' . $categories_db[ $categoria_principal['id'] ]['curl']  . '/'; ?>" class="button button--action"><?= $categoria_principal['nom_' . $lang] ?></a>
								</div>
						
							<?php
						}



 						$b = 0; // banners promos
 						$p = 0;
						foreach( $productes as  $producte ):

							if(($p && !($p%3) ) ):
								$banner = isset($banners_promos[ $b ]) ? $banners_promos[ $b ] : null;
								if( $banner ):
									?>
									<?php /* include($BASE . '_banner-card.php'); */ ?>
									<?php
								endif;
								$b++;
							endif;

							$estat = $producte_estats_db[ $producte['estat_id'] ];
							$marca = $marques_db[ $producte['marca_id'] ];

							$galeria = $modelProducteGaleria->loadAllByFields(array('producte_id' => $producte['id'] ), 'posicio ASC');
							$rel_categories = $modelProducteCategoria->loadAllByFields(array('producte_id' => $producte['id'] ), 'id ASC' );

							$promocio = $producte['promocio_id'] ? $modelProductePromocio->load( $producte['promocio_id'] ) : array();


							$url = $config['base'] . $lcurl . 'producto/';
							$ultima_categoria_rel = end( $rel_categories );
							$url .= $categories_db[ $ultima_categoria_rel['categoria_id'] ]['curl'] . '/' . HelpString::curl( $marca['nom'] ) . '-' . HelpString::curl( $producte['referencia']  );

							// snippet, ho posem en un include per poder-ho fer servir a les promocions
							include('_card_producte.php');

							$p++;
						endforeach;
						?>

			</div>
			</main>
		<?php include('_footer.php'); ?>
		<script>
			$('.page-header-branding-wrapper').stick_in_parent();
		</script>
	</body>
</html>
