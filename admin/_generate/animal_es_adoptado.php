
        <div class="form-group field_es_adoptado">
            <input type="hidden" name="es_adoptado_exists" value="1" />
            <div class="checkbox checkbox-danger">
                <?php $checked = ($formulari['es_adoptado'] == 1) ? 'checked="checked"' : "" ?>
                <input type="checkbox" data-toggle="checkbox" name="es_adoptado" id="es_adoptado" <?= $checked ?>  />
                <label for="es_adoptado" class="checkbox"><?= isset($labels['es_adoptado']) ? $labels['es_adoptado'] : 'Es_adoptado' ?>
                </label>
            </div>

            <div class="error"><?php echo $error[ 'es_adoptado' ] ?></div>
        </div>
  
        