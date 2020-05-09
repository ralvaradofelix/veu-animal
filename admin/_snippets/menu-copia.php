<div id="menu" class="col-md-2">
    <!-- <h3 class="backend-name">Clicksound</h3> -->
    <a href="#" class="fui-list toggle-menu">
        <!-- Men&uacute; -->
    </a>
    <div class="logo">
        <img src="img/menu/logo.png" alt="nom del backend">
        <ul>
            <li><a href="#">Visitar la web</a></li>
            <li>/</li>
            <li><a href="#">Logout</a></li>
        </ul>
    </div>

    <ul class="menu-items">
        <li>
            <a href="index.php" class="<?= $pagina == 'index' ? 'backend-selected ' : ''; ?>home-icon">
                <span class="fui-home img"></span>
                General
            </a>
        </li>
        <li>
            <a href="pagines.php" class="<?= $pagina == 'pagines' ? 'backend-selected ' : ''; ?>pag-icon">
                <span class="fui-windows img"></span>
                P&agrave;gines
            </a>
        </li>
        <li>
            <a href="slides.php" class="<?= $pagina == 'slides' ? 'backend-selected ' : ''; ?>slides-icon">
                <span class="fui-image img"></span>
                Slides
            </a>
        </li>
        <li>
            <a href="usuaris.php" class="<?= $pagina == 'usuaris' ? 'backend-selected ' : ''; ?>user-icon">
                <span class="fui-user img"></span>
                Usuaris
            </a>
        </li>
        <li>
            <a href="productes.php" class="<?= $pagina == 'productes' ? 'backend-selected ' : ''; ?>prod-icon">
                <span class="fui-eye img"></span>
                Productes
            </a>
        </li>
        <li>
            <a href="#" class="<?= $pagina == 'categories' ? 'backend-selected ' : ''; ?>cat-icon">
                <span class="fui-tag img"></span>
                Categories
            </a>
        </li>
        <li>
            <a href="#" class="<?= $pagina == 'news' ? 'backend-selected ' : ''; ?>news-icon">
                <span class="fui-mail img"></span>
                Newsletter
            </a>
        </li>
    </ul>
</div>