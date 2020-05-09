
           
            <div class="form-group field_pagina_id">
                <label for="field_pagina_id"><?= isset($labels['pagina_id']) ? $labels['pagina_id'] : 'Pagina_id' ?>:</label>
                <select name="pagina_id" class="form-control select2" id="field_pagina_id">
                    <option value="">-- Seleccionar</option>
                    <?php
                        $opcions = $modelPagina->loadAllByFields( array('1' => '1'), ' titol ASC' );
                        foreach( $opcions as $o ) {
                            $selected = ($formulari['pagina_id'] == $o['id']) ? 'selected="selected"' : "";
                            ?><option value="<?= $o['id'] ?>" <?= $selected ?>><?= $o['titol'] ?></option><?php
                        }
                    ?>
                </select>
                 
            </div>
             
            