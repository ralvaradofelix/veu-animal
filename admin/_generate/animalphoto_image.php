
         <div class="form-group field_image field_file">
            <label for="field_image" class="titoltag"><?= isset($labels['image']) ? $labels['image'] : 'Image' ?>:</label>
            <input type="file" name="image" id="image" />
        </div>              

            <?php
		if($formulari['image'])
		{
                    ?>
                    <div style="padding: 10px;">
                        <!-- <a target="_blank" href="../_var/animalphoto/<?php echo $obj['id'] . '-image-' . $obj['image']; ?>" style="font-weight: bold;"><?= $obj['image'] ?> (<?= HelpFile::size( $BASE . '_var/animalphoto/' . $obj['id'] . '-image-' . $obj['image']  ) ?>)</a> -->
                        <img  src="../_var/animalphoto/<?php echo $obj['id'] . '-image-' . $obj['image']; ?>" style="max-width: 100%;" alt="" />
                        <div class="form-group checkbox checkbox-danger">
                            
                            <input type="checkbox" name="del_image" id="del_image" />  <label for="del_image">Eliminar</label>
                        </div>
                    </div>
                    <?php
		}
		?>
      
         
        