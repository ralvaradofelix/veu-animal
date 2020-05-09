<?php

$BASE = '../';
include($BASE . 'init.php');

include('reg.php');

$model = $modelAnimal;

if (isset( $_GET['id'] ) && is_numeric($_GET['id'])) $obj = $model->load($_GET['id']);
else $obj = array();

$aid = $obj['id'];
$imagenes_animal = $modelAnimalPhoto->loadAllByFields(array('id_animal' => $aid));
$formulari = $obj;

foreach( array_keys($model->dates) as $field ):
    $formulari[ $field ] = ( isset($obj[ $field ]) && $obj[ $field ]) ? date('d/m/Y', $obj[ $field ] ) : '';
endforeach;

$labels = array();
$errror = array();

if (isset($_POST['accio']) && $_POST['accio'] == "guardar") {
    $formulari = $_POST;


    foreach( array_keys($model->dates) as $field ):
        if(isset($_POST[$field]) && $_POST[$field] ) $obj[ $field ] = parseInputTS($_POST[$field]);
    endforeach;

    foreach(array_keys($model->varchars) as $field):
        if(isset($formulari[$field])) {
            $obj[$field] = $formulari[$field];
        }
    endforeach;

    foreach(array_keys($model->texts) as $field):
        if(isset($formulari[$field])) {
            $obj[$field] = $formulari[$field];
        }
    endforeach;
    
    if (isset($formulari['es_adoptado'])) {
        if ($formulari['es_adoptado'] == "on") {
            $obj['es_adoptado'] = 1;
        }
    } else {
        $obj['es_adoptado'] = 0;
    }

    if (isset($_GET['id'])) {
        foreach($imagenes_animal as $element):
            if ($element['image'] == ""):
                $objPhoto = $element;
                $field = 'image';
                if ($_FILES[ $field ]['tmp_name'][$element['id']]) {
                    $objPhoto[$field] = $_FILES[ $field ]['name'][$element['id']];
                    $objPhoto[ $field . '_tmp'] = $_FILES[$field]['tmp_name'][$element['id']];
                }
               $modelAnimalPhoto->save($objPhoto);
            endif;
            if (is_array($formulari['del_nom'])) {
                foreach($formulari['del_nom'] as $key => $value):
                    if ($value == "on") {
                        $modelAnimalPhoto->delete($key);
                    }
                endforeach;
            }
        endforeach;
    }

    $errors = array();
    $errors = array_merge($errors,$model->validate($obj));
    if(! count($errors)) {
            $obj['actiu'] = isset($formulari['actiu']) ? $formulari['actiu'] : 1;
            $model->save($obj);
            if(!is_numeric($_GET['id'])):
                foreach($_FILES['image']['name'] as $key => $element):
                    $objPhoto = array();
                    $field = "image";
                    if ($_FILES[ $field ]['tmp_name'][$key]) {
                        $objPhoto[$field] = $_FILES[ $field ]['name'][$key];
                        $objPhoto[ $field . '_tmp'] = $_FILES[$field]['tmp_name'][$key];
                    }
                    $objPhoto['id_animal'] = $obj['id'];
                    $modelAnimalPhoto->save($objPhoto);
                endforeach;
            endif;

            header("Location: animal-list.php" );
            exit;
    }

}


// --------------------------- template -------------------------------------
$actiu = "animal";
$pageTitle = isset($obj['id']) ? 'Editar "' . $obj['nom'] . '"' : 'Alta animal';
include("_snippets/header.php");
?>
 
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?= $pageTitle ?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">  
        <ol class="breadcrumb">
            <li><a href="animal-list.php">Animales</a></li>
            <li class="active"><?= $pageTitle ?></li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>



<form name="modificar_apartat" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
    <input type="hidden" name="accio" value="guardar" />


    <div class="row">
        <div class="col-sm-8">

            <div class="white-box">
                <?php
                    $labels["nom"] = "Nombre";
                    include("_generate/animal_nom.php");
                ?>

                <div class="sttabs tabs-style-iconbox">
                    <nav>
                        <ul>
                            <li><a href="#section-iconbox-1" id="button_tab_descripcio" class="sticon"><span>CATALÀ</span></a></li>
                            <li><a href="#section-iconbox-2" id="button_tab_modalitats" class="sticon"><span>ESPAÑOL</span></a></li>
                        </ul>
                    </nav>
                    <div class="content-wrap">
                        <section id="section-iconbox-1">
                                    
                            <?php
                    
                                $labels["caracter_cat"] = "Carácter <small>(cat)</small>";
                                include("_generate/animal_caracter_cat.php");

                                $labels["historia_cat"] = "Historia <small>(cat)</small>";
                                include("_generate/animal_historia_cat.php");

                                $labels["misc_cat"] = "Que me hace especial? <small>(cat)</small>";
                                include("_generate/animal_misc_cat.php");
                            ?>

                        </section>
                        <section id="section-iconbox-2">
                            <?php

                                $labels["caracter_esp"] = "Carácter <small>(esp)</small>";
                                include("_generate/animal_caracter_esp.php");

                                $labels["historia_esp"] = "Historia <small>(esp)</small>";
                                include("_generate/animal_historia_esp.php");

                                $labels["misc_esp"] = "Que me hace especial? <small>(esp)</small>";
                                include("_generate/animal_misc_esp.php");

                            ?>
                        </section>
                
                    </div>
                </div>

                <button type="submit" class="save-item btn btn-primary btn-embossed"><i class="fa fa-floppy-o"></i> &nbsp; Guardar todo</button>
     
            </div><!-- end white-box -->
        </div><!-- end col -->
 

        <div class="col-sm-4">
            <div class="white-box">

                <div class=" ">
                    <?php
                        $labels["fecha_nacimiento"] = "Fecha de Nacimiento <small>ej: 01/01/2020</small>";
                        include("_generate/animal_fecha_nacimiento.php");        
                        $labels["fecha_entrada"] = "Fecha de entrada <small>ej: 01/01/2020</small>";
                        include("_generate/animal_fecha_entrada.php");      
                    ?>
                    <div class="form-group">
                        <label class="control-label">Edad:</label><br />
                        <select class="form-control" name="tamanyo">
                            <option>Seleccione el tamaño</option>
                            <option value="1" <?= ($formulari['tamanyo'] == 1) ? "selected" : "" ?>>Pequeño</option>
                            <option value="2" <?= ($formulari['tamanyo'] == 2) ? "selected" : "" ?>>Mediano</option>
                            <option value="3" <?= ($formulari['tamanyo'] == 3) ? "selected" : "" ?>>Adulto</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Sexo:</label><br />
                        <select class="form-control" name="sexo">
                            <option>Seleccione el sexo</option>
                            <option value="1" <?= ($formulari['sexo'] == 1) ? "selected" : "" ?>>Macho</option>
                            <option value="2" <?= ($formulari['sexo'] == 2) ? "selected" : "" ?>>Hembra</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Especie:</label><br />
                        <select class="form-control" name="especie">
                            <option>Seleccione la especie</option>
                            <option value="1" <?= ($formulari['especie'] == 1) ? "selected" : "" ?>>Gato</option>
                            <option value="2" <?= ($formulari['especie'] == 2) ? "selected" : "" ?>>Perro</option>
                            <option value="3" <?= ($formulari['especie'] == 3) ? "selected" : "" ?>>Conejo</option>
                            <option value="4" <?= ($formulari['especie'] == 4) ? "selected" : "" ?>>Otro</option>
                        </select>
                    </div>
                    <?php
                        $labels["raza"] = "Raza <small>ej:Gato europeo</small";
                        include("_generate/animal_raza.php");  
                        $labels["es_adoptado"] = "Adoptado";
                        include("_generate/animal_es_adoptado.php");  
                    ?>
                </div>
                <hr /> 
                <button type="submit" class="save-item btn btn-primary btn-embossed"><i class="fa fa-floppy-o"></i> &nbsp; Guardar todo</button>

            </div><!-- white box -->
        </div><!-- end col -->
        <div class="col-md-8">
            <div class="white-box">
                <h3 class="box-title">Imágenes:</h3> 
                <span onclick="addFile(<?= $aid ?>)" class="btn btn-success">Añadir Imagen</span>
                <div id="resources" style="display: flex;flex-direction: column;padding: 4px;">
                    <?php foreach($imagenes_animal as $imagen): ?>
                        <div style="display: flex;padding:20px;border-bottom: 1px solid #d7d7d7;">
                            <div>
                                <label>Imagen:</label><br />
                                <img height=150 target="_blank" src="<?= $config['base'] ?>_var/animal_photo/<?= $imagen['id'] . '-image-' . $imagen['image'] ?>" style="font-weight: bold;"><?= $imagen['nom'] ?></a>
                            </div>
                            <div style="padding-left:40px">
                                <input type="checkbox" name="del_nom[<?= $imagen['id'] ?>]" id="del_nom[<?= $imagen['id'] ?>]" />  <label for="del_nom[<?= $imagen['id'] ?>]">Eliminar</label>
                            </div>
                            <div style="padding-left:40px">
                                <span class="btn btn-info"><i class="fa fa-arrows" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <hr />
                <button type="submit" class="save-item btn btn-primary btn-embossed"><i class="fa fa-floppy-o"></i> &nbsp; Guardar todo</button>
            </div>
        </div>
    </div><!-- end row -->

</form>



<hr />
</div><!-- end row -->



<script src="js/cbpFWTabs.js"></script>

<script type="text/javascript">

function tinymcez() {

            tinymce.init({
                        selector: '.tinymce-mini',
                        theme: "modern",
                        plugins: [
                            ["advlist autolink link image lists charmap hr anchor pagebreak"],
                            ["searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking"],
                            ["table contextmenu directionality paste textcolor"]
                        ],
                        toolbar: "undo redo | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | forecolor backcolor | code",
                        statusbar: false,
                        language : 'es',
                        height: 250,
                        menubar : false
                    });

}



 
        (function () {
                [].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
                new CBPFWTabs(el);
            });
        })();


            </script>

<?php
	include("_snippets/footer.php");
?>
<script type="text/javascript">
    function addFile(id_animal) {
        $.ajax({
            url: `<?= $config['base'] ?>admin/_ajax_add-file-animal.php?id_animal=${id_animal}`,
        }).done(function(data){
            $('#resources').append(data)
        });
    }
</script>