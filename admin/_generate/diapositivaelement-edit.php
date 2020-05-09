<?php

$BASE = '../';
include($BASE . 'init.php');
include('reg.php');

$model = $modelDiapositivaElement;

if (is_numeric($_GET['id'])) $obj = $model->load($_GET['id']);
else $obj = array();

$formulari = $obj;
foreach( array_keys($model->dates) as $field ):
    $formulari[ $field ] = $obj[ $field ] ? date('d/m/Y', $obj[ $field ] ) : '';
endforeach;

$labels = array();

if (isset($_POST['accio']) && $_POST['accio'] == "guardar")
{
    $formulari = $_POST;
    
    // camps de data
    foreach( array_keys($model->dates) as $field ):
        if(isset($_POST[$field]) && $_POST[$field] ) $formulari[ $field ] = parseInputTS($_POST[$field]);
    endforeach;
    
    foreach( array_keys($model->booleans) as $field ):
        if($_POST[ $field . '_exists']) $formulari[ $field ] = isset($_POST[ $field ]) ? 1 : 0;
    endforeach;
    
    
    $obj = array_merge($obj,$formulari);
    
    // camps de fitxer
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
    
    $errors = array();
    $errors = array_merge($errors,$model->validate($obj));
    if(! count($errors)) {
            $obj['actiu'] = 1;
            $model->save($obj);
            header("Location: diapositivaelement-list.php" );
    }

}


// --------------------------- template -------------------------------------
$actiu = "diapositivaelement";
$pageTitle = ($obj['id']) ? 'Editar' : 'Alta';
include($BASE . "admin/_snippets/header.php");
?>


<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?= $pageTitle ?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">  
        <ol class="breadcrumb">
            <li><a href="diapositivaelement-list.php">diapositivaelement</a></li>
            <li class="active"><?= $pageTitle ?></li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="main col-md-10 col-md-push-1">
	 
        
<form name="modificar_apartat" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
<input type="hidden" name="accio" value="guardar" />
    <?php 
$labels["posicio"] = "Posicio";

include("_generate/diapositivaelement_posicio.php");

$labels["title_cat"] = "Title_cat";

include("_generate/diapositivaelement_title_cat.php");

$labels["title_eng"] = "Title_eng";

include("_generate/diapositivaelement_title_eng.php");

$labels["title_esp"] = "Title_esp";

include("_generate/diapositivaelement_title_esp.php");

$labels["image"] = "Image";

include("_generate/diapositivaelement_image.php");

$labels["video"] = "Video";

include("_generate/diapositivaelement_video.php");
 ?>
    
    <br />
    <button class="save-item btn btn-primary btn-embossed"><?php echo ($obj['id']) ? 'Modificar' : 'Alta';?></button>
</form>
    
<div class="clear"></div>
</div>

<?php
	include($BASE . "admin/_snippets/footer.php");
?>