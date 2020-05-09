<?php

$BASE = '../';
include($BASE . 'init.php');
include('reg.php');

if(isset($_GET['id_animal']) && is_numeric($_GET['id_animal'])): 
    $animal_id = $_GET['id_animal'];
    $obj = array();
    $obj['id_animal'] = $animal_id;
    $modelAnimalPhoto->save($obj);
?>

    <div style="display: flex;padding:20px;border-bottom: 1px solid #d7d7d7;">
        <div>
            <label for="field_nom" class="titoltag">Seleccione un archivo:</label>
            <input type="file" name="image[<?= $obj['id'] ?>]" id="image[<?= $obj['id'] ?>]" />
        </div>
    </div>
<?php else: ?>
    <div style="display: flex;padding:20px;border-bottom: 1px solid #d7d7d7;">
        <div>
            <label for="field_nom" class="titoltag">Seleccione un archivo:</label>
            <input type="file" name="image[]" id="image[]" />
        </div>
    </div>
<?php endif; ?>