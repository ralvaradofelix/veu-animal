<?php
$BASE = '../';
include($BASE . 'init.php');

class Generate {

    public function save_field( $path, $content ) {
        file_put_contents($path, $content );
    }

    public function varchar( $name ) {

        $contents =  '
        <div class="form-group">
            <label class="control-label"><?= isset($labels[\'' . $name . '\']) ? $labels[\'' . $name . '\'] : \''. ucfirst($name) . '\' ?>:</label>
          
                <input type="text" class="form-control" name="'. $name . '" id="'. $name . '" value="<?php echo h($formulari[\'' . $name . '\']); ?>"> 
            
        </div>

        ';

        return $contents;
    }

    public function text( $name ) {

        $contents =  '
        <div class="form-group">
            <label class="control-label"><?= isset($labels[\'' . $name . '\']) ? $labels[\'' . $name . '\'] : \''. ucfirst($name) . '\' ?>:</label>
            
            <textarea class="tinymce-mini" name="' . $name . '" id="' . $name . '" 
                style="width: 467px; height: 135px;"><?php echo $formulari[\'' . $name . '\'] ?></textarea>
           
        </div>
        ';

        return $contents;
    }

    public function integer( $name ) {

        $contents =  '
        <div class="form-group">
            <label class="control-label"><?= isset($labels[\'' . $name . '\']) ? $labels[\'' . $name . '\'] : \''. ucfirst($name) . '\' ?>:</label>
            <input type="text" class="form-control" name="'. $name . '" id="'. $name . '" style="max-width: 100px;" value="<?php echo $formulari[\'' . $name . '\']; ?>"> 
        </div>
        ';

        return $contents;
    }
    
    
    public function price( $name ) {

        $contents =  '
        <div class="form-group field_' . $name. '">
            <label class="control-label"><?= isset($labels[\'' . $name . '\']) ? $labels[\'' . $name . '\'] : \''. ucfirst($name) . '\' ?>:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-euro"></i></div>
                <input type="text" class="form-control" name="'. $name . '" id="'. $name . '" '
                    . 'style="max-width: 100px !important;" '
                    . 'value="<?php echo number_format( $formulari[\'' . $name . '\'], 2, ",",""); ?>"  />
            </div>
        </div>
        ';

        return $contents;
    }

    public function data( $name ) {

        $contents =  '
        
  
            <div class="form-group field_' . $name. '">
                <label for="field_' . $name . '"><?= isset($labels[\'' . $name . '\']) ? $labels[\'' . $name . '\'] : \''. ucfirst($name) . '\' ?>:</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input type="text" name="'. $name . '" id="field_'. $name . '" placeholder="dd/mm/YYYY" class="form-control" data-date-format="dd/mm/yyyy" value="<?php echo $formulari[\'' . $name . '\']; ?>" />
                </div>
            </div>
 
         
        ';

        return $contents;
    }

    public function check( $name ) {

        $contents =  '
        <div class="form-group field_' . $name. '">
            <input type="hidden" name="' . $name . '_exists" value="1" />
            <div class="checkbox checkbox-danger">
                <?php $checked = ($formulari[\'' . $name . '\'] == 1) ? \'checked="checked"\' : "" ?>
                <input type="checkbox" data-toggle="checkbox" name="'. $name . '" id="'. $name . '" <?= $checked ?>  />
                <label for="' . $name . '" class="checkbox"><?= isset($labels[\'' . $name . '\']) ? $labels[\'' . $name . '\'] : \''. ucfirst($name) . '\' ?>
                </label>
            </div>

            <div class="error"><?php echo $error[ \''. $name . '\' ] ?></div>
        </div>
  
        ';

        return $contents;
    }

    public function select( $name, $model, $opcions ) {

        if( count($opcions) == 1 && isset($opcions['model']) ) {
            $model_remote = $GLOBALS[ $opcions['model'] ];
            $contents =  '
           
            <div class="form-group field_' . $name. '">
                <label for="field_' . $name . '"><?= isset($labels[\'' . $name . '\']) ? $labels[\'' . $name . '\'] : \''. ucfirst($name) . '\' ?>:</label>
                <select name="' . $name . '" class="form-control select2" id="field_' . $name . '">
                    <option value="">-- Seleccionar</option>
                    <?php
                        $opcions = $' . $opcions['model'] . '->loadAllByFields( array(\'1\' => \'1\'), \' ' . $model_remote->to_string . ' ASC\' );
                        foreach( $opcions as $o ) {
                            $selected = ($formulari[\'' . $name . '\'] == $o[\'id\']) ? \'selected="selected"\' : "";
                            ?><option value="<?= $o[\'id\'] ?>" <?= $selected ?>><?= $o[\'' . $model_remote->to_string . '\'] ?></option><?php
                        }
                    ?>
                </select>
                 
            </div>
             
            ';

        } else {

            $contents =  '
             
            <div class="form-group field_' . $name. '">
                <label for="field_' . $name . '"><?= isset($labels[\'' . $name . '\']) ? $labels[\'' . $name . '\'] : \''. ucfirst($name) . '\' ?>:</label>
                <select name="' . $name . '"  class="form-control select2" id="field_' . $name . '">
                    ';
            foreach( $opcions as $o => $op ):
                $contents .= '
                    <?php $selected = ($formulari[\'' . $name . '\'] == \'' . $o . '\') ? \'selected="selected"\' : ""; ?>
                    <option value="' . $o . '" <?= $selected ?> >' . $op . '</option>
                    ';
            endforeach;

            $contents .= '
                </select>
                <div class="error"><?php echo $error[ \''. $name . '\' ] ?></div>
            </div> 
            
            ';
        }

        return $contents;
    }

    public function file( $name, $module_name ) {

        $contents =  '
         <div class="form-group field_' . $name. ' field_file">
            <label for="field_' . $name . '" class="titoltag"><?= isset($labels[\'' . $name . '\']) ? $labels[\'' . $name . '\'] : \''. ucfirst($name) . '\' ?>:</label>
            <input type="file" name="'. $name . '" id="'. $name . '" />
        </div>              

            <?php
		if($formulari[\''. $name . '\'])
		{
                    ?>
                    <div style="padding: 10px;">
                        <!-- <a target="_blank" href="../_var/' . $module_name . '/<?php echo $obj[\'id\'] . \'-' . $name . '-\' . $obj[\'' . $name . '\']; ?>" style="font-weight: bold;"><?= $obj[\'' . $name . '\'] ?> (<?= HelpFile::size( $BASE . \'_var/' . $module_name . '/\' . $obj[\'id\'] . \'-' . $name . '-\' . $obj[\'' . $name . '\']  ) ?>)</a> -->
                        <img  src="../_var/' . $module_name . '/<?php echo $obj[\'id\'] . \'-' . $name . '-\' . $obj[\'' . $name . '\']; ?>" style="max-width: 100%;" alt="" />
                        <div class="form-group checkbox checkbox-danger">
                            
                            <input type="checkbox" name="del_' . $name . '" id="del_' . $name . '" />  <label for="del_' . $name . '">Eliminar</label>
                        </div>
                    </div>
                    <?php
		}
		?>
      
         
        ';

        return $contents;
    }

}

$generate = $g = new Generate();

foreach( $models as $m => $model ):
    $model_nom = strtolower( get_class( $model ) );
    $fields_tpl_includes = array();

    foreach( $model->camps as $nom => $camp ):
        $path_camp = '_generate/' . $model_nom . '_' . $nom . '.php';
        switch( $camp ):
            case "date":
                if( ! in_array($nom,array('data_alta','data_modificacio'))) {
                    $g->save_field( $path_camp, $g->data( $nom ) );
                    $fields_tpl_includes[] = '$labels["' . $nom . '"] = "' . ucfirst($nom) . '";';
                    $fields_tpl_includes[] = 'include("' . $path_camp . '");';
                }
                break;

            case "boolean":
                $g->save_field( $path_camp, $g->check( $nom ) );
                $fields_tpl_includes[] = '$labels["' . $nom . '"] = "' . ucfirst($nom) . '";';
                $fields_tpl_includes[] = 'include("' . $path_camp . '");';
            break;

            case "varchar":
                if( in_array($nom, $model->saveFiles) ) {
                    $g->save_field( $path_camp, $g->file( $nom, $model_nom ) );
                } else if( array_key_exists($nom, $model->opcions) ) {
                    $g->save_field( $path_camp, $g->select( $nom, $model, $model->opcions[$nom] ) );
                } else {
                    $g->save_field( $path_camp, $g->varchar( $nom ) );
                }

                $fields_tpl_includes[] = '$labels["' . $nom . '"] = "' . ucfirst($nom) . '";';
                $fields_tpl_includes[] = 'include("' . $path_camp . '");';
            break;
            
            case "price":
                $g->save_field( $path_camp, $g->price( $nom ) );

                $fields_tpl_includes[] = '$labels["' . $nom . '"] = "' . ucfirst($nom) . '";';
                $fields_tpl_includes[] = 'include("' . $path_camp . '");';
            break;

            case "integer":

                if( array_key_exists($nom, $model->opcions) ) $g->save_field( $path_camp, $g->select( $nom, $model, $model->opcions[$nom] ) );
                else $g->save_field( $path_camp, $g->integer( $nom ) );

                $fields_tpl_includes[] = '$labels["' . $nom . '"] = "' . ucfirst($nom) . '";';
                $fields_tpl_includes[] = 'include("' . $path_camp .'");';
            break;

            case "text":
                $g->save_field( $path_camp, $g->text( $nom ) );

                $fields_tpl_includes[] = '$labels["' . $nom . '"] = "' . ucfirst($nom) . '";';
                $fields_tpl_includes[] = 'include("' . $path_camp . '");';
            break;


        endswitch;


    endforeach; // end for camps

    $edit_tpl = file_get_contents('_generate/_edit.tpl.php');
    $edit_tpl = str_replace('%model%', '$' . $m, $edit_tpl );
    $edit_tpl = str_replace('%model_nom%', $model_nom, $edit_tpl );
    $edit_tpl = str_replace('%form_fields%', "<?php \r\n" . implode("\r\n\r\n", $fields_tpl_includes) . "\r\n ?>", $edit_tpl );
    file_put_contents('_generate/' . $model_nom . '-edit.php' , $edit_tpl);

    $delete_tpl = file_get_contents('_generate/_delete.tpl.php');
    $delete_tpl = str_replace('%model%', get_class( $model ), $delete_tpl );
    file_put_contents('_generate/' . $model_nom . '-delete.php' , $delete_tpl);
    if( ! file_exists($model_nom . '-delete.php') ) file_put_contents( $model_nom . '-delete.php' , $delete_tpl);

    ?><pre><?= $model->doSQL(); ?></pre><?php
endforeach; // end for model

?>
