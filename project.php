<?php
    include('init.php');
    if ($_GET['id']) {
        $obj = $modelProjecte->load($_GET['id']);
    } else {
        mort("Ha de seleccionar un proyecto");
    }
    // template
    $pageTitle = "Proyectos";
	include('_header.php');
?>
		<main>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img id="image_project_page" src="_var/projecte/<?= $obj['id'] ?>-icon-<?= $obj['icon'] ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="project_info">
                            <div>
                                <b>PROJECTE</b><br />
                                <?= strtoupper($obj['nom_cat']) ?>
                            </div>
                            <div>
                                <strong>DATA INICI</strong><br />
                                <?= date('d/m/Y', $obj['data_inici']) ?>
                            </div>
                            <div>
                                <b>PLAÇ FINALITZACIÓ</b><br />
                                <?= date('d/m/Y', $obj['data_fin']) ?>
                            </div>
                            <div>
                                <b>OBJECTIUS</b><br />
                                <?php
                                    foreach(explode(',',$obj['objetivos_cat']) as $text):
                                        echo strtoupper($text)."<br />";
                                    endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= $obj['content_cat'] ?>
                    </div>
                </div>
            </div>
		</main>
		<?php include('_footer.php'); ?>
	</body>
</html>
