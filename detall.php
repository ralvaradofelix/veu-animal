<?php
	$BASE = './';
	include($BASE . 'init.php');

	// $noticies = $modelNoticia->loadAllByFields(array('actiu' => '1'),"data DESC");
	$productes = $modelProducte->loadAll("posicio ASC");

	$id = ( isset($_GET['id']) && is_numeric($_GET['id']) ) ? $_GET['id'] : null;
	$curl = isset($_GET['curl']) ? $_GET['curl'] : null;

	if( $id ) {
		$producte = $obj = $modelProducte->load( $id );
	}


	if( $curl ):
		$productes_db = $modelProducte->loadAll();
		$productes_tokens = array();
		foreach( $productes_db as $prod ):
			$marca = $modelProducteMarca->load( $prod['marca_id']);
			$productes_tokens[ HelpString::curl($marca['nom']) . '-' . HelpString::curl( $prod['referencia']  ) ] = $prod;
		endforeach;

		$producte = $obj = isset( $productes_tokens[ $curl ] ) ? $productes_tokens[ $curl ] : array();

	endif;



	if( ! $producte ) mort('No producte','404');

	
	$email_sended = false;



	$estat = $producte_estats_db[ $producte['estat_id'] ];
	$marca = $marques_db[ $producte['marca_id'] ];

	$galeria = $modelProducteGaleria->loadAllByFields(array('producte_id' => $producte['id'] ),'posicio ASC, id ASC');
	$rel_categories = $modelProducteCategoria->loadAllByFields(array('producte_id' => $producte['id'] ), 'id ASC' );

	$videos = $modelProducteVideo->loadAllByFields(array('producte_id' => $producte['id'] ),'posicio ASC, id ASC');
	$documents = $modelProducteDocument->loadAllByFields(array('producte_id' => $producte['id'] ),'posicio ASC, id ASC');

	$promocio = $producte['promocio_id'] ? $modelProductePromocio->load( $producte['promocio_id'] ) : array();
  
	$email_spam = isset($_POST['email']) ? $_POST['email'] : null;
	$telefon_spam = isset($_POST['telefon']) ? $_POST['telefon'] : null;
  	if( $_SERVER['REQUEST_METHOD'] == "POST" && ($email_spam || $telefon_spam) ):
		// report spam
		header('Location: ' . $config['base'] . $lcurl . 'contacto?saved=true' );
		exit;
	endif;



	if( $_SERVER['REQUEST_METHOD'] == "POST"
	  && isset($_POST['accio'])
	  && $_POST['accio'] == "contactar"):


		if( isset($_POST['name']) && trim($_POST['name']) == "" ): // seguro antispam
			$text = ct('missatge_contacte') . "
		=========================

		"  . ct('nom') . ': '  . strip_tags($_POST['nom']) . "
		"  . ct('telefon') . ': '  . strip_tags($_POST['telefon_2']) . "
		"  . ct('correo_electronico') . ': '  . strip_tags($_POST['email_2']) . "
		"  . ct('missatge') . ':
		'  . strip_tags($marca['nom'] . ' ' . $producte['referencia'] . "\n\n" . $_POST['missatge']) . "

		";

			file_put_contents($BASE . '_var/logs/' . date('dmYHis') . '-peticion-' . HelpString::curl( strip_tags($_POST['email_2']) ) . '.txt', $text );
		 
			$curl = new HelpCurl("https://cargol.cercles.io/form-submit.php?curl=oKX1vQe3", true);
			$curl->setPost(array(
					'name' => ($_POST['nom']),
					'email' => $_POST['email_2'],
					'phone' => $_POST['telefon_2'],
					'language_id' => ($lang == "cat") ? 1 : 2,
					'notes' => ( $marca['nom'] . ' ' . $producte['referencia'] . "\n\n" .  $_POST['missatge']),
					'tags[]' => ( $marca['nom'] . ' ' . $producte['referencia'] )
				));

			$curl->createCurl();
		endif;

	$email_sended = false;
	 

	header('Location: ' . $_SERVER['HTTP_REFERER'] . '?saved=true#informacion' );
	exit;

	endif;




	// -------- template
	$mostrar_categories = array();
	$categories_producte = [];
	foreach( $rel_categories as $rel ):

		$cat = $categories_db[ $rel['categoria_id'] ];
		$mostrar_categories[] = $cat['nom_' . $lang ];
		$categories_producte[] = $cat;

		// breadcrumb
		$categoria_pare = ($cat['categoria_id']) ? $modelCategoria->load( $cat['categoria_id'] ) : null;
		if( $categoria_pare ){ 
			$breadcrumb[$categoria_pare['nom_' . $lang ] . ' ' . $cat['nom_' . $lang] ] = $config['base'] . $lcurl . 'productos/' . $cat['curl'] . '/';
		} else {
			$breadcrumb[ $cat['nom_' . $lang] ] = $config['base'] . $lcurl . 'productos/' . $cat['curl'] . '/';
		}

	endforeach;


	if( count($categories_producte) == "1" && $categories_producte[0]['categoria_id'] ):
		// $categories_producte = array();
		$cat = $categories_producte[0];
		$nova = array();
		$nova[] = $categories_db[ $cat['categoria_id'] ];
		$nova[] = $cat;
		$categories_producte = $nova;
	endif;

	$categoria_principal = $categories_producte[0];



	$actiu = $categories_producte[0]['curl'];
	$actiu_submenu = $categories_producte[1]['curl'];
 
	$pageTitle = $marca['nom'] . ' ' . $producte['referencia'] . ' - ' . implode(' ', $mostrar_categories);
	$meta_title = $pageTitle;
	$meta_description = HelpString::tallaText(  $producte['descripcio_' . $lang ] );
	

	$breadcrumb[ $marca['nom'] . ' ' . $producte['referencia'] ] = $_SERVER['REQUEST_URI'];
	

	$body_class = "page_detall";
	include('_header.php');

?>

<style type="text/css">
.m-t-1rem { margin-top: 1rem !important; }
.amagat { display: none; }
</style>

		<main id="swup" class="main" role="main">

			<?php include('_breadcrumb.php'); ?>
			
			<div class="transition-fade">
				
				<div class="main__header main__header--detall main__header--fixed">
					<div class="main__title-info transition-move">
						<div class="title-marca">
							<img src="<?= $config['base'] . '_var/producte_marca/' . $marca['id'] . '-logo-' . $marca['logo'] ?>" alt="">
						</div>
						<div class="title-text">
							<h1 class="title-modelo"><?= $marca['nom'] ?> <?= $producte['referencia'] ?></h1>
							<h2 class="title-meta"><?= $producte['motor'] ?></h2>
							<?php if( $producte['es_desactivat']): ?>
								<span class="main__estado main__estado--agotadas">Lo sentimos, ya no disponemos de este producto.</span>
								<p class="main__estado">Puedes encontrar otras <a href="<?= $config['base'] . $lcurl . $marca['slug'] ?>"><?= $marca['nom'] ?></a></p>
							<?php else: ?>
								<span class="main__estado main__estado--<?= $producte_estats_db[ $producte['estat_id'] ]['token'] ?>"><?=  $producte_estats_db[ $producte['estat_id'] ]['nom_' . $lang ]  ?></span>
							<?php endif; ?>
						</div>
					</div>
					<?php if( ! $producte['es_desactivat']): ?>
					<div class="main__price price">
					<?php if( $producte['preu_mes'] ): ?>
						<p class="price__aprox"><?= t('desde') ?></p>
						<p class="price__valor"><?= $producte['preu_mes'] ?><span>&euro;/mes</span></p>
					<?php elseif( $producte['preu'] ): ?>
						<p class="price__aprox"><?= t('por_solo') ?></p>
						<p class="price__valor"><?= number_format($producte['preu'],0,',','.') ?><span>&euro;</span></p>
						<?php if( $producte['preu_info_' . $lang] ): ?>
						<span class="price__alert">* (IEDMT a determinar)</span>
						<?php endif; ?>
					<?php elseif( $producte['preu_info_' . $lang ] ): ?>
						<div class="card__price">
						<p class="price__aprox" style="display: block !important;"><?= ct('preu') ?></p>
						<p class="price__valor"><?= $producte['preu_info_' . $lang]; ?></p>
						</div>
					<?php endif; ?>
					</div>
					<?php endif ?>

					<nav class="text-nav">
						<a class="text-nav__item button" href="#descripcion"><?= ct('descripcion'); ?></a>
						<a class="text-nav__item button" href="#distribucion"><?= ct('distribucion'); ?></a>
						<a class="text-nav__item button" href="#equipamiento"><?= ct('equipamiento') ?></a>
						<a class="text-nav__item button" href="#compartir"><?= ct('compartir') ?></a>
					</nav>
				</div>
				<?php if( $promocio ): ?>
				<div class="price__promocion"><?= $promocio['nom_' . $lang ] ?></div>
				<?php endif; ?>

				<div id="informacion" class="informacion informacion--detall">
					<?php if( isset($_GET['saved']) ): ?>
						<div class="alert alert_success">
							<strong><?= ct('mensaje_enviado_correctamente') ?></strong>
							<script type="text/javascript">
								gtag('event','form sent -detail-',{
										'event_category': 'contact', 
										'event_label': 'detail'
								});</script>
						</div>
					<?php endif; ?>
					<div class="text-content__item">
						<div class="inner-mobile">
							<h2><?= ct('solicitar_informacio') ?></h2>
							<p>¿Quieres más información acerca de nuestra <strong><?= $producte['referencia'] ?></strong> de <strong><?= $marca['nom'] ?></strong>? Pregúntanos sin compromiso.</p>

							<?php if( $email_sended ): ?>
									<div class="alert alert_success">
										<strong><?= ct('mensaje_enviado_correctamente') ?></strong>
									</div>
								<?php endif; ?>
							<form name="form_contacto" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST" enctype='multipart/form-data'  onsubmit="$(this).find('.button--action').html('<i class=\'fa fa-spin fa-spinner\'></i>');">
								<input type="hidden" name="accio" value="contactar" />
									<textarea class="form__item form__item--textarea" name="missatge" id="missatge" placeholder="<?= ct('missatge'); ?>" required></textarea>
									<div class="informacion__inputs-hided">
										<input class="form__item form__item--input amagat" type="text" name="email" id="email" placeholder="<?= ct('correo_electronico'); ?>">
										<input class="form__item form__item--input" type="text" name="email_2" id="email_2" placeholder="<?= ct('correo_electronico'); ?>" required>
										<div class="columns columns--two">
											<input class="form__item form__item--input" type="text" name="telefon_2" id="telefon_2" placeholder="<?= ct('telefono'); ?>">
											<input class="form__item form__item--input" type="text" name="name" id="name" placeholder="<?= ct('name'); ?>" style="display: none">
											<input class="form__item form__item--input amagat" type="text" name="telefon" id="telefon" placeholder="<?= ct('telefono'); ?>">
											<input class="form__item form__item--input" type="text" name="nom" id="nom" placeholder="<?= ct('nom'); ?>">
										</div>
									</div>
									<button class="form__item form__item--submit button button--action" type="submit"><?= ct('enviar_missatge'); ?></button>
							</form>
							<button class="inner-mobile__close">Cancelar</button>
						</div>
						<div class="informacion__mobile-bar">
							<a href="tel:+34935621414" class="informacion__telefono"><i class="fa fa-phone"></i> 93 562 14 14</a>
							<a href="" class="informacion__form-toggle"><i class="fa fa-paper-plane" aria-hidden="true"></i> Contactar</a>
						</div>
					</div>
				</div>
				
					
				<div class="main__content content">
					<div class="content__media">
						<i class="media-zoom fa fa-2x fa-search-plus" aria-hidden="true"></i>
						<!-- <div class="media-frame"> -->
							<div class="media-carousel media-carousel--content owl-carousel" data-slider-id="1" data-name="<?= $producte['referencia'] ?>">
								<?php foreach( $galeria as $foto ): ?>
								<a rel="gallery-1" class="swipebox" data-no-swup href="<?= $config['base'] . '_var/producte_galeria/' . $foto['id'] . '-foto-' . $foto['foto'] ?>"><img class="owl-lazy" data-src="<?= $config['base'] . '_var/producte_galeria/' . $foto['id'] . '-foto-' . $foto['foto'] ?>" alt=""></a>
								<?php endforeach; ?>
							</div>
							<div class="media-info">
								<i class="fa fa-picture-o" aria-hidden="true"></i>
								<span class="media-info__span"></span>
							</div>
							<div class="media-thumbs owl-thumbs" data-slider-id="1">
								<?php foreach( $galeria as $foto ): ?>
									<button class="owl-thumb-item"><img src="<?= $config['base'] . '_var/producte_galeria/' . $foto['id'] . '-foto-' . $foto['foto'] ?>" alt=""></button>
									<?php endforeach; ?>
							</div>
						<!-- </div> -->
					</div>
					<div class="content__text">
						<div class="text-content">
							<div id="descripcion" class="text-content__item">
								<div class="content__meta meta">
									<span><i><img src="<?= $config['base'] ?>images/icons/meta/sentada.svg" alt=""></i><?= $producte['seients'] ?></span>
									<span><i><img src="<?= $config['base'] ?>images/icons/meta/durmiendo.svg" alt=""></i><?= $producte['llits'] ?></span>
									<span><i><img src="<?= $config['base'] ?>images/icons/meta/cubiertos.svg" alt=""></i><?= $producte['menjadors'] ?></span>
									<span><i><img src="<?= $config['base'] ?>images/icons/meta/largo.svg" alt=""></i><?= $producte['llargada'] ?></span>
								</div>
								<?= $producte['descripcio_' . $lang ] ?>
							</div>
							<div id="distribucion" class="text-content__item">
								<?php if( $producte['distribucio_dia'] ): ?>
								<h2><?= ct('distribucio_dia') ?></h2>
								<img src="<?= $config['base'] . '_var/producte/' . $producte['id'] . '-distribucio_dia-' . $producte['distribucio_dia'] ?>" alt="">
								<?php endif; ?>
								<?php if( $producte['distribucio_nit'] ): ?>
								<h2><?= ct('distribucio_nit') ?></h2>
								<img src="<?= $config['base'] . '_var/producte/' . $producte['id'] . '-distribucio_nit-' . $producte['distribucio_nit'] ?>" alt="">
								<?php endif; ?>
							</div>
							<div id="equipamiento" class="text-content__item">

								<?= $producte['equipament_' . $lang ] ?>

							</div>

							
							<?php if( $videos ): ?>
							<div id="videos" class="text-content__item">
								<h2><?= ct('videos') ?></h2>
								<?php foreach( $videos as $video ): ?>
									<div class="card-video">
										<?php
										$codi = HelpInternet::YoutubeCode( $video['video'] );
										?>
										<h3><?= $video['nom_' . $lang ] ?></h3>
										<div class="videoWrapper">
											<iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $codi ?>?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
										</div>
									</div>
								<?php endforeach; ?>

							</div>
							<?php endif; ?>



							<?php 
							if( $documents ): 
								?>
								<div id="documents" class="text-content__item">
									<h2><?= ct('documents') ?></h2>
									<?php foreach( $documents as $item ): ?>
										<a class="button" href="<?= $config['base'] . '_var/producte_document/' . $item['id'] . '-' . $item['document'] ?>" class="btn button--action" target="_blank"><i class="fa fa-file-pdf-o"></i> <?= $item['nom_' . $lang ] ?></a>
									<?php endforeach; ?>

								</div>
								<?php 
							endif; ?>
							<div id="compartir" class="text-content__item">
								<h2><?= ct('comparte_pagina') ?></h2>
								<div class="compartir">
									<?php 
									$text_share = $config['base'] .  ( substr($_SERVER['REQUEST_URI'],1) );
									?>
									<a class="compartir__item" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($text_share) ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a class="compartir__item" href="https://twitter.com/share?text=<?= urlencode($pageTitle) ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
									<a class="compartir__item" href="whatsapp://send?text=<?= urlencode($pageTitle . ' ' . $text_share) ?>&amp;body=<?= urlencode($pageTitle . ' ' . $text_share) ?>" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
									<a class="compartir__item" href="https://telegram.me/share/url?url=<?= urlencode($pageTitle . ' ' . $text_share) ?>&amp;body=<?= urlencode($pageTitle . ' ' . $text_share) ?>" target="_blank"><i class="fa fa-telegram" aria-hidden="true"></i></a>
								</div>
							</div>
							<?php if( ! $producte['es_desactivat']): ?>
							<div id="financiacion" class="financiacion">
								<div class="text-content__item">
									<h2><?= ct('financiacion') ?></h2>
									<form class="financiacion__form form">
										<input class="form__item form__item--input form__import" type="text"  value="<?= $producte['preu'] ? number_format($producte['preu'],0,',','.') : '' ?>"  placeholder="<?= ct('import_financiar') ?>">
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
									</form>
								</div>
								
								<div class="alert_financiacion" style="position: relative;z-index: 2;margin-top: .5rem;font-weight: bolder;padding: 1.5em 1em; display: none; ">
									<h2 class="alert__title">
										<span class="calculat">-</span>&euro;/mes </h2>
									<?= $config['app_financament_' . $lang ]; ?>
								</div>
								<div class="financiacion__image">
									<img src="<?= $config['base'] ?>images/icons/finance-icon.svg" alt="">
								</div>
							</div>
							<?php endif; ?>
 
						</div>
					</div>
				</div>
			</div>
		</main>
		<?php include('_footer.php'); ?>
	</body>
</html>
