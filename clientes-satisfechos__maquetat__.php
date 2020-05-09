<?php
	$BASE = './';
	include($BASE . 'init.php');

	$body_class="page_clients";
	include('_header.php');
?>
		<main class="main" role="main">
				<div class="grid grid_container">
					<div class="row">
						<div class="column column_xs-12 column_sm-6 column_md-4 column_lg-3">
							<div class="card-panel main__branding">
								<img class="logo" src="images/logos/cargol-logo.svg" alt="Logo Cargol Caravanes">
								<a class="button button--back" href="">Ver m&aacute;s not&iacute;cias</a>
							</div>
							<div class="card-wrapper">
								<div class="card card--banner" style="height:24rem;overflow:hidden;position:relative;padding:0">
									<img style="height:100%;margin-left-50%" src="http://media.istockphoto.com/photos/seniors-camping-picture-id536457335?s=2048x2048" alt="">
									<h2 style="color:black;position:absolute;top:5%;left:1rem;right:1rem;text-align:center">Tu sueño cada vez m&aacute;s cerca... �Aprovecha, no lo dejes escapar!</h2>
									<a class="button button--card-action button--next" style="position:absolute;bottom:0rem;right:0;left:0;background-color:white" href="">Descubre la ocasi&oacute;n
									</a>
								</div>
							</div>
						</div>
						<div class="column column column_xs-12 column_sm-6 column_md-8 column_lg-9">
							<div class="main__content content">
								<!-- <div class="main__header">
									<h2 class="title-noticia">Clientes satisfechos</h2>
									<p class="title-meta"></p>
								</div> -->
								<div class="content__media">
									<div class="media-carousel media-carousel--autoplay owl-carousel" data-slider-id="1">
										<div class="grid content__grid">
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8272-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8285-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8282-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8286-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8299-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8325-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8326-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8338-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8342-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8531-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8532-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8281-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8849-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8886-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8889-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8531-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
										</div>
										<div class="grid content__grid">
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8278-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8285-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8282-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8286-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8299-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8325-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8326-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8338-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8342-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8531-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8532-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8281-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8849-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
											<div class="grid__item">
												<img src="http://www.cargolcaravanas.com/imatge/8886-1497263694.jpg?amplada-maxima=750" alt="">
											</div>
										</div>
									</div>
								</div>
								<div class="content__text">
									<div class="text-content">
										<div class="text-content__item">
											<h3>�Cargol, 40 años de oficio y MUCHOS CLIENTES SATISFECHOS!</h3>
											<p>"Clientes satisfechos" es el valor añadido mas apreciado que una empresa puede tener, por eso, exponemos estas fotos de los clientes junto con el equipo de Cargol como muestra inequívoca de que hacemos bién nuestro trabajo.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</main>
		<img class="image-background" src="images/backgrounds/cargol-background-1.jpg" alt="">
		<?php include('_footer.php'); ?>
	</body>
</html>
