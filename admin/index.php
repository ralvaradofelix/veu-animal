<?php

header('Location: animal-list.php');
exit;

$BASE = '../';
include($BASE . 'init.php');
include('reg.php');
 

// --------------------------- template -------------------------------------
$actiu = "dashboard";
$pageTitle = 'Dashboard';
include '_snippets/header.php'; 
?>

  <!-- breadcrub -->
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= $pageTitle ?></h4> </div>
         
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        
                <?php
                
                $usuarios_login = $modelUsuari->loadAllByWhere( " DATE(login_at) >= DATE_SUB(NOW(), INTERVAL 7 DAY) ", "login_at DESC" );

                ?>
                <div class="col-md-12 col-lg-6 col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">ACCESOS AL CAMPUS</h3>

                            <div class="row sales-report">
                                <div class="col-md-8 col-sm-8 col-xs-8">
                                    <h2>ACCESO USUARIOS �NICOS</h2>
                                    <p>Hace 7 d�as</p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4 ">
                                    <h1 class="text-right text-info m-t-20"><?= count($usuarios_login) ?></h1> 
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th>LOGIN AT</th>
                                            <th>NOM</th>
                                            <th>ACCION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $nfila = 0;

                                        foreach( $usuarios_login as $item ):

                                            ?>
                                            <tr class="<?= $class ?>">
                                                <td><?= date('d-m-Y H:i:s', $item['login_at']) ?></td>
                                                <td><?= $item['nom'] . ' '  . $item['cognoms']  ?></td>
                                                <td>
                                                    <a href="mailto:<?= $item['email'] ?>"
                                                        data-toggle="tooltip" title="<?= $item['email'] ?>"
                                                        class="btn btn-xs btn-info"
                                                        ><i class="fa fa-envelope-o"></i></a>

                                                    <a href="usuari-edit.php?id=<?= $item['id'] ?>"
                                                        class="btn btn-xs btn-success"
                                                        ><i class="fa fa-pencil"></i></a>
                                                </td>
                                                 
                                            </tr>
                                            <?php
                                           
                                        endforeach;
 

                                        ?>
                                         
                                    </tbody>
                                </table>  

                                </div>
                        </div>
                    </div><!-- end col  -->


                    <div class="col-md-12 col-lg-6 col-sm-12">

                        <div class="white-box">
                            <h3 class="box-title">�LTIMOS REGISTROS</h3>


                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th>ALTA</th>
                                            <th>NOM</th>
                                            <th>ACCION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $ultimos = $modelUsuari->loadAll( "data_alta DESC LIMIT 10" );
                                    foreach( $ultimos as $item ):
                                         ?>
                                                    <tr class="<?= $class ?>">
                                                        <td><?= date('d-m-Y H:i:s', $item['data_alta']) ?></td>
                                                        <td><?= $item['nom'] . ' '  . $item['cognoms']  ?></td>
                                                        <td>
                                                            <a href="mailto:<?= $item['email'] ?>"
                                                                data-toggle="tooltip" title="<?= $item['email'] ?>"
                                                                class="btn btn-xs btn-info"
                                                                ><i class="fa fa-envelope-o"></i></a>

                                                            <a href="usuari-edit.php?id=<?= $item['id'] ?>"
                                                                class="btn btn-xs btn-success"
                                                                ><i class="fa fa-pencil"></i></a>
                                                        </td>
                                                         
                                                    </tr>
                                                    <?php
                                    endforeach;
                                    ?>
                                    </tbody>
                                    </table>
                                </div>

                        </div>

                        <div class="white-box">
                            <a href="comanda-list.php" class="label label-success pull-right">Ver lista completa</a>
                            <h3 class="box-title">�LTIMAS COMPRAS</h3>
                            
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th># / Fecha</th>
                                            <th>Usuario / Conceptos</th>
                                            <th>Total</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $ultimos = $modelComanda->loadAll( "data_alta DESC LIMIT 10" );
                                    foreach( $ultimos as $item ):
                                            $obj = $item;
                                            $u = $modelUsuari->load( $item['client_id'] );
                                            $conceptes = $modelComandaConcepte->loadAllByFields( array('comanda_id' => $obj['id'] ) );
                                            $usuari = $obj['client_id'] ? $modelUsuari->load( $obj['client_id'] ) : ''; 
                                            $te_ticket = false;
                                            foreach( $conceptes as $concepte ) {
                                                if( $concepte['producte_id'] == "6") $te_ticket = true;
                                            } 

                                         ?>
                                            <tr class="<?= $class ?>">
                                                <td>
                                                    #<?= $obj['codi'] ?><br />
                                                    <?= date('d/m/Y H:i:s', $obj['data_alta']); ?>
                                                    
                                                    </td>
                                                <td><a href="usuari-edit.php?id=<?= $usuari['id'] ?>" style="color: #1ABC9C;"><?= $usuari['nom'] . ' ' . $usuari['cognoms'] ?></a><br /><span class="text-muted"><?= $usuari['email'] ?></span> <?php 
                                                    foreach( $conceptes as $c ) {
                                                        ?><li><?= strip_tags($c['concepte']) ?></li><?php
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= number_format($obj['preu_total'],2,',','') ?>&euro;</td>
                                                <td><?php 
                                                switch ($obj['estat_id']) {
                                                    case '1':
                                                        ?>
                                                            <span class="label label-success">Pagado</span>
                                                             
                                                        <?php
                                                        break;

                                                    case '-1':
                                                    case '4':
                                                        ?>
                                                        <span class="label label-danger">Cancelado</span>
                                                        <?php
                                                        break;
                                                    
                                                    default:
                                                        ?>
                                                        <span class="label label-warning">No Pagado</span>
                                                         
                                                        <?php
                                                        break;
                                                }
                                                ?></td>
                                            </tr>
                                            <?php
                                    endforeach;
                                    ?>
                                    </tbody>
                                    </table>
                                </div>

                        </div>


                    </div>


    </div>


 

<?php include '_snippets/footer.php'; ?>