
         <div class="form-group field_video field_file">
            <label for="field_video" class="titoltag"><?= isset($labels['video']) ? $labels['video'] : 'Video' ?>:</label>
            <input type="file" name="video" id="video" />
        </div>              

            <?php
		if($formulari['video'])
		{
                    ?>
                    <div style="padding: 10px;">
                        <!-- <a target="_blank" href="../_var/diapositivaelement/<?php echo $obj['id'] . '-video-' . $obj['video']; ?>" style="font-weight: bold;"><?= $obj['video'] ?> (<?= HelpFile::size( $BASE . '_var/diapositivaelement/' . $obj['id'] . '-video-' . $obj['video']  ) ?>)</a> -->
                        <img  src="../_var/diapositivaelement/<?php echo $obj['id'] . '-video-' . $obj['video']; ?>" style="max-width: 100%;" alt="" />
                        <div class="form-group checkbox checkbox-danger">
                            
                            <input type="checkbox" name="del_video" id="del_video" />  <label for="del_video">Eliminar</label>
                        </div>
                    </div>
                    <?php
		}
		?>
      
         
        