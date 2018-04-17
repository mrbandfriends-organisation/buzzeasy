<?php
    use Roots\Sage\Setup;
    use Roots\Sage\Utils;
    use Roots\Sage\Wrapper;

    $feature_flag_classes = "";
    $active_ff = Utils\get_active_features();

    // Convert Feature Flag keys to CSS classes in form "ff-{{flag-name}}"
    if (!empty($active_ff)) {
        $feature_flag_classes = implode(" ", array_map(function($flag) {
            return "ff-" . str_replace("_", "-", $flag);
        }, array_keys( $active_ff ) ) );
    }
?><!doctype html>
<html <?php language_attributes(); ?> class="no-js <?=esc_attr( $feature_flag_classes );?>">
	<?php get_template_part('templates/head'); ?>
	<body <?php body_class(); ?>>
		<div class="offcanvas__wrapper js-offcanvas__wrapper">
			<div id="page" class="page offcanvas__body js-offcanvas-body">
				<?php
					do_action('get_header');
					get_template_part('templates/header');

                    ?>

                    <main id="main-content">
                        <?php include Wrapper\template_path(); ?>
                    </main>

                    <?php do_action('get_footer');
                    get_template_part('templates/footer');
				?>
			</div>
			<?= Utils\ob_load_template_part('templates/partials/primary-offcanvas.php'); ?>
		</div>

		<?php
            get_template_part('templates/partials/loadjs');
            get_template_part('templates/core/third-party-tools');

			wp_footer();
		?>
	</body>
</html>