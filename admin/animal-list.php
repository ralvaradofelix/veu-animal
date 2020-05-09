<?php
$BASE = '../';
include($BASE . 'init.php');
include('reg.php');

$model = $modelAnimal;

if( isset($_POST['posicio']) ) {

    foreach( $_POST['posicio'] as $id => $pos) {
        $obj = $model->load( $id );
        $obj['posicio'] = $pos;

        $model->save( $obj );
    }
}


$filtre = array('1' => '1');

// $filtre = array('es_pack' => '1');
// if( is_numeric($_GET['categoria_id']) ) $filtre['categoria_id'] = $_GET['categoria_id'];

// $objs = $model->loadAllByFields( $filtre, 'posicio ASC' );
$objs = $model->loadAllByFields(array('actiu' => 1));



// --------------------------- template ----------------------------------------- //
$actiu = "animal";
$pageTitle = 'Animales';
include("_snippets/header.php");
// include($BASE . "_snippets/admin/subnav-pagines.php");
?>


 <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?= $pageTitle ?> (<?= count($objs)  ?>)</h4>
    </div>

    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 pull-right">
      <a href="animal-edit.php" class="add-item btn btn-success btn-embossed">
        <i class="fa fa-plus"></i> &nbsp;
        Añadir animal
    </a>
    </div>
</div>

<div class="row">
<div class="col-md-12">
<div class="white-box">

<form name="curs-list_submit" action="" method="post" >
<?php


if( $objs ): ?>
    <table class="table table-striped">
        <tr>
            <th>Nombre</th>
            <th>Esta adoptado?</th>
            <th style="width: 200px;">Acciones</th>
        </tr>

        <?php foreach( $objs as $o => $obj): ?>

        <tr class="backend-item">
            <td>
                <div><strong><?= ucfirst($obj['nom']) ?></strong></div>
            </td>
            <td>
                <div><?= $obj['es_adoptado'] ? "Si" : "No" ?></div>
            </td>

            <!--
            <td>
                <span class="label left" style="<?= (!$fotos) ? 'opacity: 0.2' : '' ?>"><?= count( $fotos ) ?></span>
                <a href="paginagaleria-edit.php?id=<?= $obj['id'] ?>" class="edit fui-new right"></a>
            </td>
            -->

            <td>
                <a href="<?= $config['base'] . $obj['curl'] ?>" class="btn btn-inverse fui-new" target="_blank"><i class="fa fa-eye"></i></a>
                <a href="animal-edit.php?id=<?= $obj['id'] ?>" class="btn btn-success fui-new"><i class="fa fa-pencil"></i></a>
                <a href="animal-delete.php?id=<?= $obj['id'] ?>" onclick="return confirm('¿seguro eliminar?');" class="btn btn-default fui-cross">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>


<?php endif; ?>

<?php
if(!$objs) echo "<div class='well'>No hay registros</div>";
?>

</form>

</div>
</div>
</div>

<?php
    include($BASE . "admin/_snippets/footer.php");
?>
