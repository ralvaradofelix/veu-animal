<?php
	include('init.php');

	$curl = isset($_GET['curl']) ? $_GET['curl'] : '';

	// recorrem les noticies i agafem la que toca.
	// No ho fem per SQL perquè ens podrien enxufar SQL Injection

	$noticies = $modelNoticia->loadAll();
	$noticies_curl = array();
	foreach( $noticies as $noticia ):
		$c = HelpString::curl( $noticia['nom_' . $lang ] );
		$noticies_curl[ $c ] = $noticia;
	endforeach;

	 

	$noticia = $noticies_curl[ $curl ];
	if( ! $noticia ) mort('Not found','404');

	$galeria = $modelNoticiaGaleria->loadAllByFields( array('noticia_id' => $noticia['id']), "posicio ASC" );

	// template
	$pageTitle = $meta_title = $noticia['nom_' . $lang ];
	$meta_description = HelpString::tallaText(  $noticia['resum_' . $lang ] );
	
	$url_cat = $config['base'] . 'cat/noticia/' . HelpString::curl( $noticia['nom_cat' ] );
	$url_esp = $config['base'] . 'noticia/' . HelpString::curl( $noticia['nom_esp' ] );


	$breadcrumb[ ct('noticias') ] = $config['base'] . $lcurl . HelpString::curl(('noticias')) . '/';
	$breadcrumb[ $pageTitle ] = $_SERVER['REQUEST_URI'];
	

	$body_class="page_noticia";
	include('_header.php');
?>
		<main id="swup" class="main" role="main">

			<?php include('_breadcrumb.php'); ?>

								<?php /*

								foreach( $banners_promos as $banner ):
									include($BASE . '_banner-card.php'); 
								endforeach;
								*/
								?>

							<div class="main__content content transition-fade">
								<div class="main__header main__header_noticia">
									<h2 class="title-noticia"><?= $noticia['nom_' . $lang ] ?></h2>
								</div>
								<div class="content__media">
									<!-- <div class="media-frame"> -->
										<div class="media-carousel media-carousel--content owl-carousel" data-slider-id="1">
											<?php foreach( $galeria as $foto ): ?>
											<a rel="gallery-1" class="swipebox" href="<?= $config['base'] . '_var/noticia_galeria/' . $foto['id'] . '-foto-' . $foto['foto'] ?>"><img class="owl-lazy" data-src="/_var/noticia_galeria/<?= $foto['id'] . '-foto-' .  $foto['foto'] ?>" alt=""></a>
											<?php endforeach; ?>
										</div>
										<div class="media-info">
											<i class="fa fa-picture-o" aria-hidden="true"></i>
											<span class="media-info__span"></span>
										</div>
										<div class="media-thumbs owl-thumbs" data-slider-id="1">
										<?php foreach( $galeria as $foto ): ?>
									    <button class="owl-thumb-item"><img src="/_var/noticia_galeria/<?= $foto['id'] . '-foto-' .  $foto['foto'] ?>" alt=""></button>
										<?php endforeach; ?>
										</div>
									<!-- </div> -->
								</div>
								<div class="content__text">
									<div class="text-content">
										<div class="text-content__item">
											<p class="title-meta"><?= date('d.m.Y', $noticia['data']) ?></p>
										</div>
										<div class="text-content__item">
											<?= $noticia['descripcio_' . $lang ] ?>
											<?php /*
											<h3>Queremos agradecer a todos nuestros clientes Satisfechos que lo han hecho posible. Gracias por su confianza.</h3>
											<p>Premio del Grupo  Trigano, al Mejor resultado en ventas de Caravanas Caravelair y Autocaravanas Challenger en España.</p>


											<p><a class="button--next" href="">Ver entrevista a Joaquín Torres (Gerente mas joven del Sector)</a></p>
											*/ ?>
										</div>
									</div>
								</div>
							</div>
						
					
				
		</main>
		<?php include('_footer.php'); ?>
	</body>
</html>
