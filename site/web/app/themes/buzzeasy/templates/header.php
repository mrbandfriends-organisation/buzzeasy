<?php
    use Roots\Sage\Utils;
?>

<header class="banner">
    <a href="#main-content" class="skip-link">Skip to content</a>

    <div class="container">
    <?php
        echo Utils\ob_load_template_part('templates/partials/site-logo.php');
    ?>

    <?php
        $banner_nav_args = array(
            'modifier' => 'banner'
        );

        echo Utils\ob_load_template_part('templates/menus/primary-nav.php', $banner_nav_args);
    ?>

    <button id="menu-button" type="button" class="offcanvas-toggle offcanvas-toggle--open tcon tcon-menu--xcross js-offcanvas-toggle" aria-label="toggle menu" aria-expanded="false" aria-controls="menu">
            <span class="offcanvas-toggle__text"><span class="vh">Open menu</span></span>
            <span class="offcanvas-toggle__lines tcon-menu__lines" aria-hidden="true"></span>
    </button>

    </div>
</header>
