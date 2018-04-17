<?php
//use Roots\Sage\DropDownWalker;
use Roots\Sage\Services\Menu;

echo Menu::get('primary_navigation', [
    'container_class' => 'menu-primary menu-primary--' . $modifier,
    'menu_class'      => 'nav-primary nav-primary--' . $modifier,
]);

    // Wordpress BEM Menu
    //
    // Use this when creating dropdowns and/or mega menus.
    // It allows you to contruct a wordpress menu with custom classes based on BEM.
    // For information how to use the menu go to : https://github.com/roikles/Wordpress-Bem-Menu
?>

<!-- <nav class="<?php //echo esc_attr($container_class); ?> js-accessible-mega-menu" role="navigation" aria-label="Main Navigation">
    <?php //DropDownWalker\bem_menu('primary_navigation', null, $menu_class); ?>
</nav>-->
