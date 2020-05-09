<?php

$BASE = '../';
include($BASE . 'init.php');
include('reg.php');

$model = $modelPagina;

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
            header("Location: pagina-list.php" );
    }

}


// --------------------------- template -------------------------------------
$actiu = "pagina";
$pageTitle = ($obj['id']) ? 'Editar' : 'Alta';
include($BASE . "admin/_snippets/header.php");
?>


<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?= $pageTitle ?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">  
        <ol class="breadcrumb">
            <li><a href="pagina-list.php">pagina</a></li>
            <li class="active"><?= $pageTitle ?></li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="main col-md-10 col-md-push-1">
	 
        
<form name="modificar_apartat" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
<input type="hidden" name="accio" value="guardar" />
    <?php 
$labels["pagina_id"] = "Pagina_id";

include("_generate/pagina_pagina_id.php");

$labels["posicio"] = "Posicio";

include("_generate/pagina_posicio.php");

$labels["actiu"] = "Actiu";

include("_generate/pagina_actiu.php");

$labels["titol_cat"] = "Titol_cat";

include("_generate/pagina_titol_cat.php");

$labels["subtitol_cat"] = "Subtitol_cat";

include("_generate/pagina_subtitol_cat.php");

$labels["titol_esp"] = "Titol_esp";

include("_generate/pagina_titol_esp.php");

$labels["subtitol_esp"] = "Subtitol_esp";

include("_generate/pagina_subtitol_esp.php");

$labels["titol_eng"] = "Titol_eng";

include("_generate/pagina_titol_eng.php");

$labels["subtitol_eng"] = "Subtitol_eng";

include("_generate/pagina_subtitol_eng.php");

$labels["curl"] = "Curl";

include("_generate/pagina_curl.php");

$labels["foto"] = "Foto";

include("_generate/pagina_foto.php");

$labels["header"] = "Header";

include("_generate/pagina_header.php");

$labels["content_cat"] = "Content_cat";

include("_generate/pagina_content_cat.php");

$labels["content_esp"] = "Content_esp";

include("_generate/pagina_content_esp.php");

$labels["content_eng"] = "Content_eng";

include("_generate/pagina_content_eng.php");
 ?>
    
    <br />
    <button class="save-item btn btn-primary btn-embossed"><?php echo ($obj['id']) ? 'Modificar' : 'Alta';?></button>
</form>
    
<div class="clear"></div>
</div>

<?php
	include($BASE . "admin/_snippets/footer.php");
?>