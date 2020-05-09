<?php

$BASE = '../';
include($BASE . 'init.php');
include('reg.php');

$model = $modelAnimal;

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
            header("Location: animal-list.php" );
    }

}


// --------------------------- template -------------------------------------
$actiu = "animal";
$pageTitle = ($obj['id']) ? 'Editar' : 'Alta';
include($BASE . "admin/_snippets/header.php");
?>


<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?= $pageTitle ?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">  
        <ol class="breadcrumb">
            <li><a href="animal-list.php">animal</a></li>
            <li class="active"><?= $pageTitle ?></li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="main col-md-10 col-md-push-1">
	 
        
<form name="modificar_apartat" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
<input type="hidden" name="accio" value="guardar" />
    <?php 
$labels["fecha_nacimiento"] = "Fecha_nacimiento";

include("_generate/animal_fecha_nacimiento.php");

$labels["fecha_entrada"] = "Fecha_entrada";

include("_generate/animal_fecha_entrada.php");

$labels["actiu"] = "Actiu";

include("_generate/animal_actiu.php");

$labels["es_adoptado"] = "Es_adoptado";

include("_generate/animal_es_adoptado.php");

$labels["nom"] = "Nom";

include("_generate/animal_nom.php");

$labels["especie"] = "Especie";

include("_generate/animal_especie.php");

$labels["sexo"] = "Sexo";

include("_generate/animal_sexo.php");

$labels["raza"] = "Raza";

include("_generate/animal_raza.php");

$labels["edat"] = "Edat";

include("_generate/animal_edat.php");

$labels["tamanyo"] = "Tamanyo";

include("_generate/animal_tamanyo.php");

$labels["misc_esp"] = "Misc_esp";

include("_generate/animal_misc_esp.php");

$labels["caracter_esp"] = "Caracter_esp";

include("_generate/animal_caracter_esp.php");

$labels["historia_esp"] = "Historia_esp";

include("_generate/animal_historia_esp.php");

$labels["misc_cat"] = "Misc_cat";

include("_generate/animal_misc_cat.php");

$labels["caracter_cat"] = "Caracter_cat";

include("_generate/animal_caracter_cat.php");

$labels["historia_cat"] = "Historia_cat";

include("_generate/animal_historia_cat.php");
 ?>
    
    <br />
    <button class="save-item btn btn-primary btn-embossed"><?php echo ($obj['id']) ? 'Modificar' : 'Alta';?></button>
</form>
    
<div class="clear"></div>
</div>

<?php
	include($BASE . "admin/_snippets/footer.php");
?>