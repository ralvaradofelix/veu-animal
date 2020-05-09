<?php

	// routing bucle htaccess
	if( $_SERVER['REQUEST_URI'] == "/financiacion.php" ) {
		header("HTTP/1.1 301 Moved Permanently"); 
		header('Location: /financiacion/');
		exit;
	}

	// routing bucle htaccess
	if( $_SERVER['REQUEST_URI'] == "/financiacion" ) {
		header("HTTP/1.1 301 Moved Permanently"); 
		header('Location: /financiacion/');
		exit;
	}

	// routing bucle htaccess
	if( $_SERVER['REQUEST_URI'] == "/cat/financiacion" ) {
		header("HTTP/1.1 301 Moved Permanently"); 
		header('Location: /cat/financament/');
		exit;
	}


	$BASE = './';
	include($BASE . 'init.php');

	$curl = isset($_GET['curl']) ? $_GET['curl'] : '';
	$pagina = $modelPagina->load( 14 );

	// template
	$pageTitle = $meta_title = $noticia['nom_' . $lang ];

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
	

	$pageTitle = $pagina['titol_' . $lang];
	if( ! $breadcrumb ) $breadcrumb[ $pageTitle ] = $_SERVER['REQUEST_URI'];
	$url_cat = $config['base'] . "cat/financament/";
	$url_esp = $config['base'] . "financiacion/";
	
	$actiu = 'financiacion';
	$body_class="page_noticia";
	include('_header.php');
?>
		<main id="swup" class="main" role="main">

		<?php include('_breadcrumb.php'); ?>
						
			<!--<div class="card-wrapper">
					<?php /*
					
					foreach( $banners_promos as $banner ):
							include($BASE . '_banner-card.php'); 
					endforeach; */
						?>
			</div>-->

			<h1 class="main__title transition-move"><?= $pageTitle ?></h1>

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
					<?php if( $pagina['subtitol_' . $lang ] ): ?><h2><?= $pagina['subtitol_' . $lang ] ?></h2><?php endif; ?>
				</div>
				<div class="content__text">
					<div class="text-content">
						<?php 
							$seccions = $modelPaginaSeccio->loadAllByFields( array('pagina_id' => $pagina['id'] ), 'posicio ASC, id ASC' );
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


				<div id="financiacion" class="financiacion is-focus">
					<div class="text-content__item">
						<h2><?= ct('financiacion') ?></h2>
						<form class="financiacion__form form">
							<div class="row">
								<input class="form__item form__item--input form__import" type="text" placeholder="<?= ct('import_financiar') ?>">
								<label class="form__item form__item--select button--down">
									<select>
										<?php 
										$financaments = $modelFinancament->loadAll("posicio ASC, id ASC");
										foreach( $financaments as $item ): 
											?>
											<option value="<?= $item['numero'] ?>" data-rel="<?= $item['coef'] ?>"><?= $item['nom_' . $lang ] ?></option>
											<?php 
										endforeach; 
										?>
									</select>
								</label>
								<input class="form__item form__item--submit button button--action jsCalcularFinanciacion" type="submit" value="Calcular" />
							</div>
						</form>
					</div>

					<div class="alert alert_financiacion">
						<h2 class="alert__title"><span class="calculat">300,00</span>&euro;/mes </h2>
						<?= $config['app_financament_' . $lang ]; ?>
					</div>
					
					<div class="financiacion__image">
						<img src="<?= $config['base'] ?>images/icons/finance-icon.svg" alt="">
					</div>
				</div>


			</div>
		</main>
		<?php include('_footer.php'); ?>

	</body>
</html>
