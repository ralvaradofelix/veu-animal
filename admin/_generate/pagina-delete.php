<?php
$BASE = "../";
include($BASE . 'init.php');
include('reg.php');

$model = model('Pagina');

if(is_numeric($_GET['id'])):	
    $foto = $model->load($_GET['id']);
    $model->delete($_GET['id']);
else:
    mort('Ha d\'especificar un registre.');
endif;

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>