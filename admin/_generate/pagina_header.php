
         <div class="form-group field_header field_file">
            <label for="field_header" class="titoltag"><?= isset($labels['header']) ? $labels['header'] : 'Header' ?>:</label>
            <input type="file" name="header" id="header" />
        </div>              

            <?php
		if($formulari['header'])
		{
                    ?>
                    <div style="padding: 10px;">
                        <!-- <a target="_blank" href="../_var/pagina/<?php echo $obj['id'] . '-header-' . $obj['header']; ?>" style="font-weight: bold;"><?= $obj['header'] ?> (<?= HelpFile::size( $BASE . '_var/pagina/' . $obj['id'] . '-header-' . $obj['header']  ) ?>)</a> -->
                        <img  src="../_var/pagina/<?php echo $obj['id'] . '-header-' . $obj['header']; ?>" style="max-width: 100%;" alt="" />
                        <div class="form-group checkbox checkbox-danger">
                            
                            <input type="checkbox" name="del_header" id="del_header" />  <label for="del_header">Eliminar</label>
                        </div>
                    </div>
                    <?php
		}
		?>
      
         
        