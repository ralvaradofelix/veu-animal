<?php
    $BASE = './';
    include($BASE . 'init.php');

    $pagina = $modelPagina->load( 11 );
    $clients = $modelClientSatisfet->loadAll();


    // template
    $pageTitle = $meta_title = $pagina['titol_' . $lang ];
    $meta_description = $pagina['subtitol_' . $lang ];

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
    
    
    $body_class="page_clients";
    include($BASE . '_header.php');
?>
        <main class="main" role="main">
                <div class="grid grid_container">
                    <div class="row">
                        <div class="column column_xs-12 column_sm-6 column_md-4 column_lg-3">
                            <div class="card-panel main__branding">
                                <a href="<?= $config['base']?>"><img class="logo" src="<?= $config['base'] ?>images/logos/cargol-logo.svg" alt="Logo Cargol Caravanes"></a>
                                <a class="button button--back" href="<?= $config['base'] . $lcurl . 'noticias/' ?>"><?= ct('ver_noticias') ?></a>
                                <a class="button button--back" href="<?= $config['base'] . $lcurl . 'productos/' ?>"><?= ct('ver_expositor') ?></a>
                            </div>
                            <div class="card-wrapper">
                                <?php 
                                
                                foreach( $banners_promos as $banner ):
                                    include($BASE . '_banner-card.php'); 
                                endforeach;
                                 ?>
                            </div>
                        </div>
                        <div class="column column column_xs-12 column_sm-6 column_md-8 column_lg-9">
                            <div class="main__content content">
                                <!-- <div class="main__header">
                                    <h2 class="title-noticia">Clientes satisfechos</h2>
                                    <p class="title-meta"></p>
                                </div> -->


                                <div class="content__media content__media_satisfet">
                                    <div class="media-carousel media-carousel--autoplay owl-carousel" data-slider-id="1">
                                        <?php
                                        $blocs = array_chunk( $clients, 16 );
                                        foreach( $blocs as $fotos ):
	                                        ?>
	                                        <div class="grid content__grid">
	                                            <?php foreach( $fotos as $foto ): ?>
	                                            <div class="grid__item">
	                                                <img src="<?= $config['base'] . '_var/client_satisfet/' . $foto['id'] . '-foto-' . $foto['foto'] ?>" alt="">
	                                            </div>
	                                            <?php endforeach; ?>
	                                        </div>
	                                        <?php
                                        endforeach;
 										?>
                                    </div>
                                </div>


                                <div class="content__text">
                                    <div class="text-content">

                                    	<?php
											$seccions = $modelPaginaSeccio->loadAllByFields( array('pagina_id' => $pagina['id'] ) );
											foreach( $seccions as $seccio ):
												?>
		                                        <div class="text-content__item">
													<h3><?= $seccio['titol_' . $lang ] ?></h3>
													<?= $seccio['descripcio_' . $lang ] ?>

		                                        </div>
												<?php
											endforeach;
											?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
        <img class="image-background" src="<?= $config['base'] ?>images/backgrounds/cargol-background-1.jpg" alt="">
        <?php include($BASE . '_footer.php'); ?>
    </body>
</html>
