
         <div class="form-group field_foto field_file">
            <label for="field_foto" class="titoltag"><?= isset($labels['foto']) ? $labels['foto'] : 'Foto' ?>:</label>
            <input type="file" name="foto" id="foto" />
        </div>              

            <?php
		if($formulari['foto'])
		{
                    ?>
                    <div style="padding: 10px;">
                        <!-- <a target="_blank" href="../_var/pagina/<?php echo $obj['id'] . '-foto-' . $obj['foto']; ?>" style="font-weight: bold;"><?= $obj['foto'] ?> (<?= HelpFile::size( $BASE . '_var/pagina/' . $obj['id'] . '-foto-' . $obj['foto']  ) ?>)</a> -->
                        <img  src="../_var/pagina/<?php echo $obj['id'] . '-foto-' . $obj['foto']; ?>" style="max-width: 100%;" alt="" />
                        <div class="form-group checkbox checkbox-danger">
                            
                            <input type="checkbox" name="del_foto" id="del_foto" />  <label for="del_foto">Eliminar</label>
                        </div>
                    </div>
                    <?php
		}
		?>
      
         
        