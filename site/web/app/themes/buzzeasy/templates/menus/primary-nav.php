<?php
use Roots\Sage\Services\Menu;
?>

<?= Menu::get('primary-navigation', [
    'container_class' => 'menu-primary menu-primary--' . $modifier,
    'menu_class'      => 'nav-primary nav-primary--' . $modifier,
]); ?>
