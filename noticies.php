<?php
	$BASE = './';
	include($BASE . 'init.php');

	// $noticies = $modelNoticia->loadAllByFields(array('actiu' => '1'),"data DESC");
	$noticies = $modelNoticia->loadAll("data DESC");

	$url_cat = '/cat/noticies/';
	$url_esp = '/noticias/';
	
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
	

	$pageTitle = $meta['title'] ? $meta['title'] : ct('noticias');
	if( ! $breadcrumb ) $breadcrumb[ $pageTitle ] = $_SERVER['REQUEST_URI'];
	

	$active = "noticias";
	$body_class="page--noticias";
	include('_header.php');
?>
		<main id="swup" class="main" role="main">

			<?php include('_breadcrumb.php'); ?>

			<div class="transition-fade">

				<h1 class="main__title transition-move"><?= $pageTitle ?></h1>
		
				<div class="card card--destacados">
					<div class="row">
						<div class="column column_xs-12">
							<div class="card__media">
								<?php if( $config['app_noticies_banner_foto_' . $lang ] ): ?>
								<a href="<?= $config['app_noticies_banner_link_' . $lang ] ?>"><img class="media-image" src="<?= $config['base'] . '_var/config_projecte/' . $config['app_noticies_banner_foto_' . $lang ] ?>" alt=""></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
						

				<div class="gird grid_container">

 
						<?php 
						$b = 0; // comptador de banners
						$p = 0; // comptador de cards
						foreach( $noticies as $noticia ):
							
							/*
							if(( !($p%3) ) ):
								$banner = isset($banners_promos[ $b ]) ? $banners_promos[ $b ] : null;
								if( $banner ):
									?>
									<div class="card-wrapper column column_xs-12 column_sm-6 column_md-4 column_lg-3">
										<?php include($BASE . '_banner-card.php'); ?>
									</div>
									<?php
								endif;
								$b++;
							endif;
							*/

							$curl = HelpString::curl( $noticia['nom_' . $lang ] );
							?>
							<div class="card card--noticia">
								<a href="<?= $config['base'] .  $lcurl . 'noticia/' . $curl  ?>">
									<div class="card__media">
										<img class="media-image" src="<?= $config['base'] . '_var/noticia/' . $noticia['id'] . '-foto_principal-' . $noticia['foto_principal'] ?>" alt="">
									</div>
								</a>
								<div class="card__header">
									<a href="<?= $config['base'] .  $lcurl . 'noticia/' . $curl  ?>">
									<h2 class="title-noticia"><?= $noticia['nom_' . $lang ] ?></h2>
									</a>
								</div>
								<div class="card__meta">
									<span class="title-meta"><?= date('d.m.Y', $noticia['data']) ?></span>
								</div>
								<div class="card__text">
									<p><?= $noticia['resum_' . $lang ] ?></p>
								</div>

							</div>
						<?php 
						$p++;
						endforeach; ?>

					</div>

				</div>
				
			</main>
		<?php include('_footer.php'); ?>
	</body>
</html>
