<?php
 
	$curl = isset($_GET['curl']) ? $_GET['curl'] : '';
 	

	//
	// routing
	//


	if( file_exists($curl . '.php') ) {
		include( $curl . '.php' );
		exit;
	}
	

 

	// --------------------	
	// pagina
	// --------------------

	include('init.php');


	// recorrem les noticies i agafem la que toca.
	// No ho fem per SQL perquè ens podrien enxufar SQL Injection

	$pagines = $modelPagina->loadAll();
	$pagines_curl = array();
	foreach( $pagines as $item ):
		$c = $item['curl'];
		$pagines_curl[ $c ] = $item;
	endforeach;

	

	$pagina = $pagines_curl[ $curl ];
	if( ! $pagina ) {
		// mort('Not found','404');
		// mirem que no sigui marca

		$marca = null;
		foreach( $marques_db as $marca ):
			if( $marca['slug'] == $curl ):


				$init_included = true;
				$_GET['marca_id'] = $marca['id'];

				include('expositor.php');
				exit;

			endif;
		endforeach;

		// mort('Not found','404');
		header("Location: /404", true, 404);
		exit;


	}


	// template
	$pageTitle = $meta_title = $noticia['nom_' . $lang ];
	
	if( ! $breadcrumb ) $breadcrumb[$pageTitle] = $_SERVER['REQUEST_URI'];

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
	
	
	$body_class="page_noticia";
	include('_header.php'); ?>

		<main id="swup" class="main" role="main">

			<div class="main__content content transition-fade">
				<?php if( $pagina['foto'] ): ?>
				<div class="content__media">
					<!-- <div class="media-frame"> -->
						
						<div class="media-carousel media-carousel--content owl-carousel" data-slider-id="1">
							<a rel="gallery-1" class="swipebox" href="<?= $config['base'] . '_var/pagina/' . $pagina['id'] . '-foto-' . $pagina['foto'] ?>"><img class="owl-lazy" data-src="/_var/pagina/<?= $foto['id'] . '-foto-' .  $foto['foto'] ?>" alt=""></a>
						</div>
						

						<div class="media-info">
							<i class="fa fa-picture-o" aria-hidden="true"></i>
							<span class="media-info__span"></span>
						</div>
						<div class="media-thumbs owl-thumbs" data-slider-id="1">
							<button class="owl-thumb-item"><img src="/_var/pagina/<?= $pagina['id'] . '-foto-' .  $pagina['foto'] ?>" alt=""></button>
						</div>
					<!-- </div> -->
				</div>
				<?php endif; ?>
				<div class="main__header main__header_noticia">
					<h2 class="title-noticia"><?= $pagina['titol_' . $lang ] ?></h2>
					<?php if( $pagina['subtitol_' . $lang ] ): ?><h3 class="title-noticia"><?= $pagina['subtitol_' . $lang ] ?></h3><?php endif; ?>
				</div>
				<div class="content__text">
					<div class="text-content">
						<?php 
							$seccions = $modelPaginaSeccio->loadAllByFields( array('pagina_id' => $pagina['id'] ) , 'posicio ASC, id ASC' );
							foreach( $seccions as $seccio ):
								?>
								<div class="text-content__item">
								<h2><?= $seccio['titol_' . $lang ] ?></h2>
								<?= $seccio['descripcio_' . $lang ] ?>
								</div>
								<?php
							endforeach;
						?>
					</div>
				</div>
			</div>
			
		</main>
		<?php include('_footer.php'); ?>
	</body>
</html>
