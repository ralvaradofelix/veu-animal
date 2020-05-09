
        <div class="form-group field_actiu">
            <input type="hidden" name="actiu_exists" value="1" />
            <div class="checkbox checkbox-danger">
                <?php $checked = ($formulari['actiu'] == 1) ? 'checked="checked"' : "" ?>
                <input type="checkbox" data-toggle="checkbox" name="actiu" id="actiu" <?= $checked ?>  />
                <label for="actiu" class="checkbox"><?= isset($labels['actiu']) ? $labels['actiu'] : 'Actiu' ?>
                </label>
            </div>

            <div class="error"><?php echo $error[ 'actiu' ] ?></div>
        </div>
  
        