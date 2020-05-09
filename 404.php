<?php
$BASE = './';

// analitzem la url

$parts = explode('/', $_SERVER['REQUEST_URI'] );

if( $parts[1] == "ca" ) $_GET['lang'] = $lang = 'cat';
if( $parts[1] == "cat" ) $_GET['lang'] = $lang = 'cat';
if( $parts[1] == "esp" ) $_GET['lang'] = $lang = 'esp';
if( $parts[1] == "es" ) $_GET['lang'] = $lang = 'es';

if( ! file_exists('_var/logs') ) mkdir('_var/logs',0775);
file_put_contents('_var/logs/404.log', date('Y-m-d H:i:s') . "\t" . $_SERVER['REQUEST_URI']  . "\t" . $_SERVER['HTTP_REFERER'] . "\n", FILE_APPEND );

include($BASE . 'init.php');

$body_class="page_error404";
include('_header.php');
?>
		<main id="swup" class="main transition-fade" role="main">
			<div class="card__header" style="background-color:red">
				<div class="grid grid_container">
					<div class="column column_xs-12 column_sm-6 column_md-9 column_sm-offset-6 column_md-offset-3">
						<h1>Error 404</h1>
					</div>
				</div>
			</div>
			<div class="card__content">
				<div class="grid grid_container">
					<div class="row" style="position:relative">
						<div class="column column_xs-12 column_sm-6 column_md-9 column_sm-offset-6 column_md-offset-3">
							<h2><?= ct('no_encontrada') ?></h2>
							<p><?= ct('no_encontrada_descripcio') ?></p>
							<?php 

							
							$subcategoria = null;
							$parts = explode('/', $_SERVER['REQUEST_URI'] );


							if( in_array($parts[2], array("productes", "productos")) 
									&& in_array($parts[3], array("caravanas","caravanes"))  ) {
								$subcategoria = '<a href="' . $config['base'] . $lcurl . 'productos/caravanas/">' . ct('caravanas') . '</a>';
							}

							if( in_array($parts[2], array("productes", "productos")) 
									&& in_array($parts[3], array("autocaravanas","autocaravanes"))  ) {
								$subcategoria = '<a href="' . $config['base'] . $lcurl . 'productos/autocaravanas/">' . ct('autocaravanas') . '</a>';
							}




							$expositor = $config['base'] . $lcurl . 'productos/';
							?>
							<p><?php printf(ct('no_encontrada_redireccio'), '/', $subcategoria, $expositor) ?></p>
						</div>
						<img src="/images/icons/cargol-oh.svg" alt="" style="pointer-events:none">
					</div>
				</div>
			</div>

		</main>
		<?php include('_footer.php'); ?>
		<script>
			$('.page-header-branding-wrapper').stick_in_parent();
		</script>
	</body>
</html>
