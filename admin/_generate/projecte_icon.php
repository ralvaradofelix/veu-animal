
         <div class="form-group field_icon field_file">
            <label for="field_icon" class="titoltag"><?= isset($labels['icon']) ? $labels['icon'] : 'Icon' ?>:</label>
            <input type="file" name="icon" id="icon" />
        </div>              

            <?php
		if($formulari['icon'])
		{
                    ?>
                    <div style="padding: 10px;">
                        <!-- <a target="_blank" href="../_var/projecte/<?php echo $obj['id'] . '-icon-' . $obj['icon']; ?>" style="font-weight: bold;"><?= $obj['icon'] ?> (<?= HelpFile::size( $BASE . '_var/projecte/' . $obj['id'] . '-icon-' . $obj['icon']  ) ?>)</a> -->
                        <img  src="../_var/projecte/<?php echo $obj['id'] . '-icon-' . $obj['icon']; ?>" style="max-width: 100%;" alt="" />
                        <div class="form-group checkbox checkbox-danger">
                            
                            <input type="checkbox" name="del_icon" id="del_icon" />  <label for="del_icon">Eliminar</label>
                        </div>
                    </div>
                    <?php
		}
		?>
      
         
        