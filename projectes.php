<?php
    include('init.php');
    $projectes = $modelProjecte->loadAll();
    // template
    $pageTitle = "Proyectos";
	include('_header.php');
?>
		<main>
            <!-- <div class="container">
                <div class="row">
                <?php
                    foreach($projectes as $pr) { ?>
                        <div class="col-md-6">
                            <img width="400" height="300" src="_var/projecte/<?= $pr['id'] ?>-icon-<?= $pr['icon'] ?>">
                        </div>
                    <?php }
                ?>
                </div>
            </div> -->
            <div class="projects_page">
                <?php foreach($projectes as $pr): ?>
                    <div class="projects_child">
                        <a href="<?= $config['base'] ?>project.php?id=<?= $pr['id'] ?>"><img width="400" height="300" src="_var/projecte/<?= $pr['id'] ?>-icon-<?= $pr['icon'] ?>"></a>
                    </div>
                <?php endforeach; ?>
            </div>
		</main>
		<?php include('_footer.php'); ?>
	</body>
</html>
