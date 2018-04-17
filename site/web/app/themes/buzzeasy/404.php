<?php
/**
 *
 * Template Name: 404 Page
 *
 */
?>


<section class="container">

    <div class="alert alert-warning">
            <?php _e('Sorry, but the page you were trying to view does not exist.', 'sage'); ?>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn">
            Go Home
        </a>

        <?php get_search_form(); ?>
    </div>

</section>
