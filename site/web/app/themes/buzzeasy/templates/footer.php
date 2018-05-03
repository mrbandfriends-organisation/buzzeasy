<?php

    use Roots\Sage\Utils;
    use Roots\Sage\Extras;
    use Roots\Sage\Services\Menu;
    use Buzzeasy\App\Utilities\SiteOptions;

    $options = new SiteOptions();
    $address = $options->field('address')->escape('html');

?>

<footer class="footer content-info band">
  <h2 class="vh">Buzzeasy Footer Section</h2>
  <div class="container">
    <div class="grid">
        <div class="gc t1-1 m1-4 footer__site-logo">
            <?= Utils\ob_load_template_part('templates/partials/site-logo--white.php'); ?>
        </div>
        <div class="gc t1-2 m1-4">
            <div class="footer__left-column">
                <div>
                    <?php
                        echo Menu::get('footer_navigation', [
                            'container_class' => 'menu-footer',
                            'menu_class'      => 'nav-footer',
                        ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="gc t1-2 m1-4">
            <div class="footer__left-column">
                <div>
                    <p class="footer__address">
                        <?= nl2br( $address ); ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="gc t1-1 m1-4 footer__site-info">
            <div class="social-menu">
                <h3 class="vh heading--white">Buzzeasy Social Menu</h3>
                <?= Utils\ob_load_template_part('templates/partials/shared/social-menu.php'); ?>
            </div>
            &copy; Buzzeasy <?php echo date("Y"); ?><br /> Site by <a class="text--underlined" href="https://www.mrbandfriends.co.uk" <?= Extras\link_open_new_tab_attrs(); ?>>Mr B &amp; Friends</a></p>
        </div>
    </div>
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>
</footer>

<?php get_template_part('templates/partials/corejs'); ?>
<?php get_template_part('templates/partials/third-party-tools'); ?>