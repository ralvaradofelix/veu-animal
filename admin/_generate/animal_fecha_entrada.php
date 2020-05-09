
        
  
            <div class="form-group field_fecha_entrada">
                <label for="field_fecha_entrada"><?= isset($labels['fecha_entrada']) ? $labels['fecha_entrada'] : 'Fecha_entrada' ?>:</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input type="text" name="fecha_entrada" id="field_fecha_entrada" placeholder="dd/mm/YYYY" class="form-control" data-date-format="dd/mm/yyyy" value="<?php echo $formulari['fecha_entrada']; ?>" />
                </div>
            </div>
 
         
        