<?php
$BASE = '../';
include($BASE . 'init.php');
include('reg.php');

$model = $modelSlideGaleria;

$ids = isset($_POST['ids']) ? explode(",",$_POST['ids']) : array();

foreach( $ids as $k => $id ):
    if( is_numeric($id) ):
        $obj = $model->load( $id );
        $obj['posicio'] = $k;
        $model->save( $obj );
        echo('el id es '.$id.'y la posicion es '.$k);
    endif;
endforeach;
 
echo 1;
exit;
