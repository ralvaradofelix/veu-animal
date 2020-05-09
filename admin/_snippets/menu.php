    <?php

    $menu = array(
        
        array(
            'icon' => 'mdi-cat fa-fw',
            'label' => 'Animales',
            'href' => 'animal-list.php',
            'active' => ($actiu == "animal")
        ),

        array(
            'icon' => 'mdi-folder-multiple-image fa-fw',
            'label' => 'Diapositivas',
            'href' => 'diapositivas-list.php',
            'active' => ($actiu == "slide")
        ),

        'separator',

           // config
        array(
            'icon' => 'mdi-settings fa-fw',
            'label' => 'Configuraci&oacute;',
            'href' => 'configuracio.php',
            'active' => ($actiu == "configuracio")
            ),

  


        );

?>

        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Menu</span></h3> </div>
                <ul class="nav" id="side-menu">
                    
                    <?php 
                    foreach( $menu as $opcio ): 
                        if( ! is_array( $opcio) ) {
                            ?><li class="devider"></li><?php
                            continue;
                        }
                    ?>
                    <li> <a href="<?= $opcio['href'] ?>" class="waves-effect <?= $opcio['active'] ? 'active' : '' ?>"
                        <?php /* class="waves-effect" */ ?>
                        ><i class="mdi <?= $opcio['icon'] ?>" data-icon="v"></i> 
                    <span class="hide-menu"> <?= $opcio['label'] ?> 
                        <!-- <span class="fa arrow"></span>  -->
                        <!-- <span class="label label-rouded label-inverse pull-right">4</span> -->
                    </span>
                    </a>
                    <!--
                        <ul class="nav nav-second-level">
                            <li> <a href="index.html"><i class=" fa-fw">1</i><span class="hide-menu">Dashboard 1</span></a> </li>
                            <li> <a href="index2.html"><i class=" fa-fw">2</i><span class="hide-menu">Dashboard 2</span></a> </li>
                            <li> <a href="index3.html"><i class=" fa-fw">3</i><span class="hide-menu">Dashboard 3</span></a> </li>
                        </ul>
                        -->
                    </li>
                <?php endforeach; ?>

                </ul>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->