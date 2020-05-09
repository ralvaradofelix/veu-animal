
        <div class="form-group field_is_hidden">
            <input type="hidden" name="is_hidden_exists" value="1" />
            <div class="checkbox checkbox-danger">
                <?php $checked = ($formulari['is_hidden'] == 1) ? 'checked="checked"' : "" ?>
                <input type="checkbox" data-toggle="checkbox" name="is_hidden" id="is_hidden" <?= $checked ?>  />
                <label for="is_hidden" class="checkbox"><?= isset($labels['is_hidden']) ? $labels['is_hidden'] : 'Is_hidden' ?>
                </label>
            </div>

            <div class="error"><?php echo $error[ 'is_hidden' ] ?></div>
        </div>
  
        