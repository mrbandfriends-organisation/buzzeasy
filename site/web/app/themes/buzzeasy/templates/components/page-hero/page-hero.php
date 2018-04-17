<?php
    use Roots\Sage\Assets;
    use Roots\Sage\Utils;


    // CONTENT
    $heading       = ( !empty($heading) ) ? $heading : null;
    $sub_heading   = ( !empty($sub_heading) ) ? $sub_heading : null;
    $bg_image      = ( !empty($bg_image) ) ? $bg_image : null;
    $bg_image_id   = ( !empty($bg_image['id']) ) ? $bg_image['id'] : null;
    $bg_image_data = Assets\bg_image_data( $bg_image_id );


    // MODIFIERS
    $heading_modifier     = ( !empty($heading_modifier) ) ? $heading_modifier : null;
    $sub_heading_modifier = ( !empty($sub_heading_modifier) ) ? $sub_heading_modifier : null;
?>

<?php if (!empty($heading) ): ?>
    <section class="page-hero lazyload" data-bgset="<?= esc_attr($bg_image_data); ?>">
    	<div class="container">


            <?php if( !empty($heading_with_spans) || !empty($sub_heading) ) : ?>
                <div class="page-hero__inner">
                    <?php if( !empty($heading) ) : ?>
                        <header>
                            <h1 class="page-hero__heading heading--alpha <?= esc_attr($heading_modifier); ?>">
                                <?= Utils\esc_textarea__($heading); ?>
                            </h1>
                        </header>
                    <?php endif; ?>

                    <?php if( !empty($sub_heading) ) : ?>
                        <h2 class="heading--charlie <?= esc_attr($sub_heading_modifier); ?>">
                            <?= esc_html($sub_heading); ?>
                        </h2>
                    <?php endif; ?>
                </div>
            <?php endif; ?>


    	</div>
    </section>
<?php endif; ?>
