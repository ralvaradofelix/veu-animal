<div class="page-header__menu">
  <div class="menu-principal-inner">
    <nav class="menu menu--principal">

      <!-- categories -->

      <!-- <?php $mactive = ($actiu == "contacto") ? '-current' : null;  ?>
      <a class="menu__item <?= $mactive ?>" href="<?= $config['base'] . $lcurl ?>contacto">
        <i><img src="/images/icons/contacto-icon.svg" alt=""></i>
        Conócenos
      </a> -->

      <?php 
      $mcategories = $modelCategoria->loadAllByFields(array('categoria_id' => '0'), 'posicio ASC, id ASC'); 
      foreach( $mcategories as $principal ):
        $fills = $modelCategoria->loadAllByFields(array('categoria_id' => $principal['id']), 'posicio ASC, id ASC');

        // té algun fill actiu ?
        $subfill_actiu = false;
        foreach( $fills as $cat_buscado ):
          if($actiu_submenu == $cat_buscado['curl_' . $lang ] ) $subfill_actiu = true;
        endforeach;

        $mactive = ($actiu == $principal['curl_' . $lang]) ? '-active' : null;
        if( ! $subfill_actiu && $mactive ) $mactive .= ' -current';

        ?>
        <div class="menu__item menu__item--submenu <?= $mactive ?>">
        <!-- <i><img src="/images/icons/autocaravana-icon.svg" alt=""></i> -->
          <a href="<?= $config['base'] . $lcurl ?>productos/<?= $principal['curl_' . $lang ] ?>/">
            <?= $principal['nom_' . $lang ] ?>
          </a>
          <button class=menu__submenu-trigger>
            <i class="fa fa-chevron-down" aria-hidden="true"></i>
          </button>
        </div>

        <div class="menu menu__submenu" <?= $mactive ? 'style="display: block"' : null ?>>
        <?php 
          foreach( $fills as $cat_buscado ):
            $mactive = ($actiu_submenu == $cat_buscado['curl_' . $lang ] ) ? '-current' : null;
            ?>
            <a class="menu__item <?= $mactive ?>" href="<?= $config['base'] . $lcurl . 'productos/' . $cat_buscado['curl_' . $lang ] . '/' ?>"><?= $principal['nom_' . $lang ] ?> <?= $cat_buscado['nom_' . $lang ] ?></a>
            <?php
          endforeach;
          ?>
        </div>
        <?php 
      endforeach; 
      ?>
      <!-- /end -->

      <?php $mactive = ($actiu == "financiacion") ? '-current' : null;  ?>
      <a class="menu__item <?= $mactive ?>" href="<?= $config['base'] . $lcurl ?><?= $lang == "cat" ? 'financament' : 'financiacion' ?>/">
        <!-- <i><img src="/images/icons/finance-icon.svg" alt=""></i> -->
        <?= ct('financiacion') ?>
      </a>

      <?php $mactive = ($actiu == "noticias") ? '-current' : null;  ?>
      <a class="menu__item <?= $mactive ?>" href="<?= $config['base'] . $lcurl ?><?= $lang == 'cat' ? 'noticies' : 'noticias' ?>/">
        <!-- <i><img src="/images/icons/noticias-icon.svg" alt=""></i> -->
        <?= ct('noticias') ?>
      </a>

      <?php $mactive = ($actiu == "contacto") ? '-current' : null;  ?>
      <a class="menu__item <?= $mactive ?>" href="<?= $config['base'] . $lcurl ?><?= strtolower(t('contacte')) ?>/">
        <!-- <i><img src="/images/icons/contacto-icon.svg" alt=""></i> -->
        <?= ct('contacte') ?>
      </a>

      <div class="menu__item transition">
					<a href="<?= $config['base'] . $lcurl ?>promos/" class="dialog-tab__trigger button button_theme_yellow">
					<?= ct('promociones') ?>
					</a>
      </div>

    </nav>
    <!-- <nav class="menu menu--principal">
      <h2 class="menu__title">Por marca</h2>
      <?php 
      $marques = $modelProducteMarca->loadAll("posicio ASC");
      foreach( $marques as $menu_marca ):
        ?>
        <a class="menu__link" href="<?= $config['base'] . $lcurl . $menu_marca['slug'] ?>">
          <?= $menu_marca['nom'] ?>
        </a>
        <?php
      endforeach; ?>
    </nav>
    <nav class="menu menu--principal">
      
        <h2 class="menu__title">Por tipo</h2>
        <?php 
        foreach( $categories_db as $cat_buscado ):
          // només fills
          if( ! $cat_buscado['categoria_id'] ) continue;

          ?>
          <a class="menu__link" href="<?= $config['base'] . $lcurl . 'productos/' . $cat_buscado['curl'] . '/' ?>"><?= $cat_buscado['curl_' . $lang ] ?></a>
          <?php
        endforeach; 
        ?>

    </nav> -->
  </div>
</div>