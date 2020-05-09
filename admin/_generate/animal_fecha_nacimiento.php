
        
  
            <div class="form-group field_fecha_nacimiento">
                <label for="field_fecha_nacimiento"><?= isset($labels['fecha_nacimiento']) ? $labels['fecha_nacimiento'] : 'Fecha_nacimiento' ?>:</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input type="text" name="fecha_nacimiento" id="field_fecha_nacimiento" placeholder="dd/mm/YYYY" class="form-control" data-date-format="dd/mm/yyyy" value="<?php echo $formulari['fecha_nacimiento']; ?>" />
                </div>
            </div>
 
         
        