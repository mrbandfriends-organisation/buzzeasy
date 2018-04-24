<?php

    use Roots\Sage\Utils;
    use Roots\Sage\Extras;

?>

<footer class="footer content-info band">
  <h2 class="vh">Buzzeasy Footer Section</h2>
  <div class="container">
    <div class="grid">
        <div class="gc t1-1 s1-4">
            <?= Utils\ob_load_template_part('templates/partials/site-logo.php'); ?>
        </div>
        <div class="gc t1-1 s1-4">
            <div class="footer__left-column">
                <h3 class="vh heading--white">Buzzeasy Footer Navigation</h3>
                
                <div class="social-menu">
                    <h3 class="vh heading--white">Buzzeasy Social Menu</h3>
                    <p class="social-menu__text text--uppercase">Find us on Social</p>
                    <?= Utils\ob_load_template_part('templates/partials/shared/social-menu.php'); ?>
                </div>
            </div>
        </div>
        <div class="gc t1-1 s2-4">
            © Buzzeasy <?php echo date("Y"); ?>. All Rights Reserved. <br /> <a class="text--underlined" href="https://www.mrbandfriends.co.uk" <?= Extras\link_open_new_tab_attrs(); ?>>Site by Mr B & Friends</a></p>
        </div>
    </div>
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>
</footer>

<?php get_template_part('templates/partials/corejs'); ?>
<?php get_template_part('templates/partials/third-party-tools'); ?>