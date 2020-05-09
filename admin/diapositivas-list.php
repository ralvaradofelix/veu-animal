<?php

$BASE = '../';
include($BASE . 'init.php');

include('reg.php');

$model = $modelDiapositivaElement;

$objs = $modelDiapositivaElement->loadAll( "posicio ASC, id ASC" );
$imatges_actuals = count($objs); 

if (isset($_POST['accio']) && $_POST['accio'] == "guardar_posiciones") {
    $formulari = $_POST;
    foreach($formulari['position'] as $key => $value) {
        $obj = $modelDiapositivaElement->load($key);
        $obj['posicio'] = $value;
        $modelDiapositivaElement->save($obj);
    }
    header("Location: diapositivas-list.php" );
    exit;
}


// --------------------------- template -------------------------------------
$actiu = "slide";
$pageTitle = "Diapositives";
include("_snippets/header.php");
?>
 
<div class="row bg-title">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <h4 class="page-title"><?= $pageTitle ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">  
        <div class="adders" style="display: flex;justify-content: right;">
            <a href="diapositivas-edit.php?type=1" class="save-item btn btn-success btn-embossed" style="margin-right: 3px;"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp; Afegir imatge</a>
            <a href="diapositivas-edit.php?type=2" class="save-item btn btn-warning btn-embossed"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp; Afegir vídeo</a>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>


<form name="modificar_apartat" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
    <input type="hidden" name="accio" value="guardar_posiciones" />
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <?php if( $objs ): ?>
                    <table class="table table-striped">
                        <tr>
                            <th>Títol</th>
                            <th>Posición</th>
                            <th style="width: 200px;">Accions</th>
                        </tr>

                        <?php foreach( $objs as $obj): ?>

                            <tr class="backend-item">   
                                <td>
                                    <?= $obj['title_cat'] ?>
                                </td>
                                <td>
                                    <input name="position[<?= $obj['id'] ?>]" size="4" type="number" value="<?= $obj['posicio'] ?>" />
                                </td>
                                <td>
                                    <a href="diapositivas-edit.php?id=<?= $obj['id'] ?>" class="btn btn-success fui-new"><i class="fa fa-pencil"></i></a>
                                    <a href="diapositivaelement-delete.php?id=<?= $obj['id'] ?>" onclick="return confirm('¿seguro eliminar?');" class="btn btn-default fui-cross">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>

                <?php if(!$objs) echo "<div class='well'>No hi ha registres</div>"; ?>
            </div><!-- end white-box -->
            <button type="submit" class="save-item btn btn-primary btn-embossed"><i class="fa fa-floppy-o"></i> &nbsp; Guardar posicions</button>
        </div><!-- end col -->
    </div><!-- end row -->
</form>

<?php
	include("_snippets/footer.php");
?>
<script>
// acepta 1 => image, 2 => video
    const addDiapositiva = (type) => {
        $.ajax({
            url: `_ajax_add_diapositiva.php?type=${type}`
        }).done((res) => {
            $('#diapositivas').append(res)
        });
    }
</script>