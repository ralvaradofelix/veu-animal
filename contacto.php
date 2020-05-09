<?php
	// routing bucle htaccess
	if( $_SERVER['REQUEST_URI'] == "/contacto" ) {
		header("HTTP/1.1 301 Moved Permanently"); 
		header('Location: /contacto/');
		exit;
	}

	// routing bucle htaccess
	if( $_SERVER['REQUEST_URI'] == "/contacte" ) {
		header("HTTP/1.1 301 Moved Permanently"); 
		header('Location: /cat/contacte/');
		exit;
	}

	// routing bucle htaccess
	if( $_SERVER['REQUEST_URI'] == "/cat/contacto" ) {
		header("HTTP/1.1 301 Moved Permanently"); 
		header('Location: /cat/contacte/');
		exit;
	}

	// routing bucle htaccess
	if( $_SERVER['REQUEST_URI'] == "/cat/contacte" ) {
		header("HTTP/1.1 301 Moved Permanently"); 
		header('Location: /cat/contacte/');
		exit;
	}


	$BASE = './';
	include($BASE . 'init.php');

	$pagina = $modelPagina->load( 10 );

	$email_spam = isset($_POST['email']) ? $_POST['email'] : null;
	$telefon_spam = isset($_POST['telefon']) ? $_POST['telefon'] : null;

	if( $_SERVER['REQUEST_METHOD'] == "POST" && ($email_spam || $telefon_spam) ):
		// report spam
		header('Location: ' . $config['base'] . $lcurl . 'contacto?saved=true' );
		exit;
	endif;


	if( $_SERVER['REQUEST_METHOD'] == "POST"
	  && isset($_POST['accio'])
	  && $_POST['accio'] == "contactar"
		):

	$text = ct('missatge_contacte') . "
=========================

"  . ct('nom') . ': '  . strip_tags($_POST['nom']) . "
"  . ct('telefon') . ': '  . strip_tags($_POST['telefon_2']) . "
"  . ct('correo_electronico') . ': '  . strip_tags($_POST['email_2']) . "
"  . ct('missatge') . ':
'  . strip_tags($_POST['missatge']) . "

";

	file_put_contents($BASE . '_var/logs/' . date('dmYHis') . '-contact-' . HelpString::curl( strip_tags($_POST['email_2']) ) . '.txt', $text );

	 
	$curl = new HelpCurl("https://cargol.cercles.io/form-submit.php?curl=8vKO5Ye4", true);
	$curl->setPost(array(
			'name' => ($_POST['nom']),
			'email' => $_POST['email_2'],
			'phone' => $_POST['telefon_2'],
			'language_id' => ($lang == "cat") ? 1 : 2,
			'notes' => ($_POST['missatge']),
		));

	$curl->createCurl();
	 

	header('Location: ' . $config['base'] . $lcurl . 'contacto?saved=true' );
	exit;

	endif;


	// template
	$pageTitle = $meta_title = $pagina['titol_' . $lang ];
    $meta_description = $pagina['subtitol_' . $lang ];
    $url_cat = $config['base'] . 'cat/contacte/';
    $url_esp = $config['base'] . 'contacto/';


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
	
	$breadcrumb[ $pagina['titol_' . $lang ] ] = $_SERVER['REQUEST_URI'];

	$actiu = "contacto";
	$body_class="page_contacto";
	include($BASE . '_header.php');
?> 
		<main id="swup" class="main" role="main">
			<style type="text/css">
	.amagat{ display: none; }
</style>

			<?php include('_breadcrumb.php'); ?>
			<h1 class="main__title transition-move"><?= $pageTitle ?></h1>
			<div class="main__content content transition-fade">
				<div class="content__text">
					<div class="text-content">
						<div class="text-content__item">

							<?php if( isset($_GET['saved']) ): ?>
								<div class="alert alert_success">
									<strong><?= ct('mensaje_enviado_correctamente') ?></strong>
									<script type="text/javascript">
										gtag('event','form sent -contacto-',{
								        'event_category': 'contact', 
								        'event_label': 'contacto'
								    });</script>
								</div>
							<?php endif; ?>

							<?php
							$seccions = $modelPaginaSeccio->loadAllByFields( array('pagina_id' => $pagina['id'] ) );
							foreach( $seccions as $seccio ):
								?>
								<h2><?= $seccio['titol_' . $lang ] ?></h2>
								<?= $seccio['descripcio_' . $lang ] ?>
								<?php
							endforeach;
							?>


							<h3><?= ct('formulario_contacto') ?></h3>
							<form name="form_contacto" action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST" enctype='multipart/form-data' onsubmit="$(this).find('.button--action').html('<i class=\'fa fa-spin fa-spinner\'></i>');">
								<input type="hidden" name="accio" value="contactar" />
								<input class="form__item form__item--input" type="text" name="nom" id="nom" placeholder="<?= ct('nom'); ?>">

								<input class="form__item form__item--input amagat" type="text" name="telefon" id="telefon" placeholder="<?= ct('telefono'); ?>">
								<input class="form__item form__item--input" type="text" name="telefon_2" id="telefon_2" placeholder="<?= ct('telefono'); ?>" required="true">

								<input class="form__item form__item--input amagat" type="text" name="email" id="email" placeholder="<?= ct('correo_electronico'); ?>">
								<input class="form__item form__item--input" type="text" name="email_2" id="email_2" placeholder="<?= ct('correo_electronico'); ?>">

								<textarea class="form__item form__item--textarea" name="missatge" id="missatge" placeholder="<?= ct('missatge'); ?>"></textarea>
								<button class="form__item form__item--submit button button--action" type="submit"><?= ct('enviar_missatge'); ?></button>
							</form>
							<!-- <div id="map-canvas"></div> -->
						</div>
					</div>
				</div>
			</div>	
				
		</main>
		<?php include($BASE . '_footer.php'); ?>
	</body>
</html>
