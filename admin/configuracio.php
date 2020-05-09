<?php
$BASE = '../';
include($BASE . 'init.php');
include('reg.php');



if ( isset($_POST['accio']) && $_POST['accio'] == "guardar")
{
    $formulari = $_POST;
    foreach( $_POST['configs'] as $clau => $valor ) {
        $reg = $modelConfigProjecte->loadByFields( array( 'clau' => $clau ) );
        $reg['valor'] = $valor;
        $modelConfigProjecte->save( $reg );
    }
         

      $config_foto = $modelConfigProjecte->loadByFields( array('clau' => 'background') );
      if( $_FILES['background']['tmp_name'] || $_POST['eliminar_background']    ) {
 
        if( $_POST['eliminar_background'] ) {
            $config_foto['valor'] = "";
        }

        if( $_FILES['background']['tmp_name'] ) {

            move_uploaded_file($_FILES['background']['tmp_name'], '../_var/config_projecte/' . $_FILES['background']['name'] );
            $config_foto['valor'] = $_FILES['background']['name'];

        }

        $modelConfigProjecte->save( $config_foto );
      }



     $config_foto = $modelConfigProjecte->loadByFields( array('clau' => 'background_video') );
      if( $_FILES['background_video']['tmp_name'] || $_POST['eliminar_background_video']  ) {


        if( $_POST['eliminar_background_video'] ) {
            $config_foto['valor'] = "";
        }

        if( $_FILES['background']['tmp_name'] ) {
            move_uploaded_file($_FILES['background_video']['tmp_name'], '../_var/config_projecte/' . $_FILES['background_video']['name'] );
            $config_foto['valor'] = $_FILES['background_video']['name'];
        }

        $modelConfigProjecte->save( $config_foto );
      }


 
   
    header('Location: configuracio.php');
    exit;
 


}


// --------------------------- template -------------------------------------
$actiu = "configuracio";
$pageTitle = 'Configuració General';
include '_snippets/header.php'; 
?>

  <!-- breadcrub -->
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?= $pageTitle ?></h4> </div>
                     
                    <!-- /.col-lg-12 -->
                </div>



        <form name="form_guardar" action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" enctype="multipart/form-data" >
            <input type="hidden" name="accio" value="guardar" />


                <!-- /row -->
                <div class="row">


                    <div class="col-sm-6">
                        <div class="white-box">
                            <label>Fons de pàgina <span style="font-weight: 300;">(Format: jpg, 1280 x 738px) < 1 MB:</span></label>
                            <input type="file" name="background" value="" />
                            <?php if( $config['app_background'] ): 
                                 ?>
                                    <img src="<?= $BASE . '_var/config_projecte/' . $config['app_background'] ?>" width="400" />
                                    <div><label><input type="checkbox" name="eliminar_background" value="1" /> &nbsp; Eliminar fotografia</label></div>
                                    <?php
                                else:
                                    ?>
                                    <img src="<?= $BASE ?>images/backgrounds/video-cargol.png" width="400" />
                                    <?php
                                endif;
                                ?>

                              <div class="m-t-10">   
                                <button class="save-item btn btn-primary btn-embossed">Guardar valors</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="white-box">
                            <label>Video de pàgina <span style="font-weight: 300;">(video mp4 - h264 encoder) < 20 MB:</span></label>
                            <input type="file" name="background_video" value="" />
                            <?php if( $config['app_background_video'] ):  
                                    ?><video width="320" height="240" controls>
                                          <source src="<?= $BASE . '_var/config_projecte/' . $config['app_background_video'] ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                        </video>
                                        <div><label><input type="checkbox" name="eliminar_background_video" value="1" /> &nbsp; Eliminar video</label></div>
                                        <?php
                                else:
                                    ?><video width="320" height="240" controls>
                                          <source src="<?= $BASE ?>images/backgrounds/cargol.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                        </video><?php
                                endif;
                                ?>

                          <div class="m-t-10">          
                            <button class="save-item btn btn-primary btn-embossed">Guardar valors</button>
                        </div>
        
                        </div>
                    </div>



                    <div class="col-sm-6">
                        <div class="white-box">
                            <label>Slogan inici <span style="font-weight: 300; font-size: smaller;">(ESP)</span></label> 
                            <textarea name="config[app_slogan_esp]" class="form-control tinymce-mini"><?= $config['app_slogan_esp'] ?></textarea>
                            <div class="m-t-10">          
                            <button class="save-item btn btn-primary btn-embossed">Guardar valors</button>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-sm-6">
                        <div class="white-box">
                            <label>Slogan inici <span style="font-weight: 300; font-size: smaller;">(CAT)</span></label> 
                            <textarea name="config[app_slogan_cat]" class="form-control tinymce-mini"><?= $config['app_slogan_cat'] ?></textarea>
                            <div class="m-t-10">          
                            <button class="save-item btn btn-primary btn-embossed">Guardar valors</button>
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-sm-12">
                        <div class="white-box">


        	<div class="inner-main">
                <?php

                $configs = $modelConfigProjecte->loadAllByFields(array('is_hidden' => '0', 'is_hidden' => ''),"posicio ASC, id ASC");
                
                ?>
        		<table class="table">
                            <tr>
                                <?php 
                                $k = 0;
                                foreach( $configs as $c ): 
                                    if( $c['is_hidden'] ) continue;
                                    
                                    ?>
                                    <?php if( ! ($k++%2) ): ?>
                                    </tr><tr>   
                                    <?php endif; ?>
                                        
                                    <td>
                                        <p class="key-table"><?= $c['nom'] ?>:</p>
                                        <input type="text" name="configs[<?= $c['clau'] ?>]" value="<?= h($c['valor']) ?>" placeholder="<?= $c['nom'] ?>" class="form-control" />
                                    </td>
                                <?php endforeach; ?>
                                     
                                       
                            </tr>
                             
        		</table>
	       </div>
            
            <button class="save-item btn btn-primary btn-embossed">Guardar valors</button>
        
        
        
        <!-- 
	<p class="backend-label-section">Otros campos:</p>
	<div class="inner-main">
		<table class="table">
			<tr>
				<td>
					<p class="key-table">Key:</p>
					<input type="text" placeholder="Nom de la KEY" class="form-control" />
				</td>
				<td>
					<p class="key-table">Key:</p>
					<input type="text" placeholder="Nom de la KEY" class="form-control" />
				</td>
			</tr>
		</table>
	</div>
        -->


</div><!-- end white box -->
</div><!-- end col -->
</div><!-- end row -->

</form>

<?php include '_snippets/footer.php'; ?>