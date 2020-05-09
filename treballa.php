<?php
    include('init.php');
    $ofertas = $modelOferta->loadAll();
    // template
    $pageTitle = "oferta";
	include('_header.php');
?>
		<main> 
            <div class="container">
                <div class="row">
                    <div class="col-md-12 icon_and_title">
                        <img class="icon_pages" src="<?= $config['base'] ?>/_var/res/ofertas.png" />
                        <span><b>TREBALLA AMB NOSALTRES</b></span>
                    </div>
                    <div class="col-md-12 text_page">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec ligula vel elit semper ultrices. Ut ultricies felis sit amet erat suscipit, ac dignissim dui fermentum. Aenean id leo pretium, faucibus ante sagittis, elementum quam. Nunc ac velit tortor. Integer sed lorem neque. Aenean viverra diam nec justo accumsan pulvinar.
                    </div>
                </div>
                <div class="row container_ofertas" >
                    <?php foreach($ofertas as $oferta): ?>
                        <div class="col-md-12 row_oferta">
                            <span style="line-height: 1em;">
                                <b><?= $oferta['titol_cat'] ?></b><br />
                                <small><?= $oferta['ubicacio_cat'] ?></small>
                            </span>
                            <div>
                                <span style="padding-right: 25px;">
                                    <?= date('d.m.Y', $oferta['data']) ?>
                                </span>
                                <a class="inscriure_button"><b>Inscriure'm</b></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
		</main>
		<?php include('_footer.php'); ?>
	</body>
</html>
