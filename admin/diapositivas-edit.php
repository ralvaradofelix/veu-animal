<?php
$BASE = '../';
include($BASE . 'init.php');

include('reg.php');

$model = $modelDiapositivaElement;
$labels = array();

if (isset( $_GET['id'] ) && is_numeric($_GET['id'])) $obj = $model->load($_GET['id']);
else $obj = array();

$type = isset($_GET['type']) ? ($_GET['type'] == 1) ? 'image' : 'video' : 0;

$formulari = $obj;

if (isset($_POST['accio']) && $_POST['accio'] == "guardar") {
    $formulari = $_POST;

    foreach(array_keys($model->varchars) as $field):
        if(isset($formulari[$field])) {
            $obj[$field] = $formulari[$field];
        }
    endforeach;

    foreach( $model->saveFiles as $field ):
        if ($_FILES[ $field ]['tmp_name'] || $_POST['del_' . $field]) {
            $formulari[$field] = $_FILES[ $field ]['name'];
            $formulari[ $field . '_tmp'] = $_FILES[$field]['tmp_name'];
        }

        if ($formulari[$field . '_tmp'] || $_POST['del_' . $field]) {
                $obj[$field] = $formulari[$field];
                $obj[$field . '_tmp'] = $formulari[$field . '_tmp'];
        }
    endforeach;

    $sql = "SELECT max(posicio) as n FROM `diapositiva_element` WHERE 1";
    $rows = $modelDiapositivaElement->loadQuery($sql);
    $obj['posicio'] = intval($rows['n']) + 1;

    $errors = array();
    $errors = array_merge($errors,$model->validate($obj));
    if(! count($errors)) {
            $model->save($obj);
            header("Location: diapositivas-list.php" );
            exit;
    }
    exit;
}

// --------------------------- template -------------------------------------
$actiu = "slide";
$pageTitle = isset($obj['id']) ? 'Editar diapositiva' : 'Nueva diapositiva';
include("_snippets/header.php");
?>
 
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?= $pageTitle ?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">  
        <ol class="breadcrumb">
            <li><a href="pagina-list.php">Diapositivas</a></li>
            <li class="active"><?= $pageTitle ?></li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>

<form name="modificar_apartat" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
    <input type="hidden" name="accio" value="guardar" />
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <?php
                    $labels["title_cat"] = "Título <small>(cat)</small>";
                    include("_generate/diapositivaelement_title_cat.php");
                    $labels["title_esp"] = "Título <small>(esp)</small>";
                    include("_generate/diapositivaelement_title_esp.php");
                    $labels["title_eng"] = "Títol <small>(eng)</small>";
                    include("_generate/diapositivaelement_title_eng.php");
                    if ($type) {
                        $labels[$type] = "Archivo</small>";
                        include("_generate/diapositivaelement_".$type.".php");
                    } else {
                        if (isset($obj['video']) && $obj['video'] != '' ) {
                            $labels[$type] = "Video</small>";
                            include("_generate/diapositivaelement_video.php");
                        } elseif(isset($obj['image'])) {
                            $labels[$type] = "Imagen</small>";
                            include("_generate/diapositivaelement_image.php");
                        }
                    }
                ?>
            </div><!-- end white-box -->
            <button type="submit" class="save-item btn btn-primary btn-embossed"><i class="fa fa-floppy-o"></i> &nbsp; Guardar</button>
        </div><!-- end col -->
    </div><!-- end row -->
</form>

<?php
	include("_snippets/footer.php");
?>
