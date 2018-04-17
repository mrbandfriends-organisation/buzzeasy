<?php
    use Roots\Sage\Assets;
    use Roots\Sage\Utils;


    // CONTENT
    $heading       = ( !empty($heading) ) ? $heading : '';
    $sub_heading   = ( !empty($sub_heading) ) ? $sub_heading : '';
    $cta_link      = ( !empty($cta_link) ) ? $cta_link : '';
    $cta_text      = ( !empty($cta_text) ) ? $cta_text : '';
    $copy          = ( !empty($copy) ) ? $copy : '';


    // MODIFIERS
    $band                 = ( !empty($band) ) ? $band : 'band';
    $grid_modifier        = ( !empty($grid_modifier) ) ? $grid_modifier : 'grid--landmark';
    $grid_col             = ( !empty($grid_col) ) ? $grid_col : 'gc m1-2';
    $heading_level        = ( !empty($heading_level) ) ? $heading_level : '2';
    $heading_modifier     = ( !empty($heading_modifier) ) ? $heading_modifier : '';
    $sub_heading_modifier = ( !empty($sub_heading_modifier) ) ? $sub_heading_modifier : '';
    $sub_heading_level    = ( !empty($sub_heading_level) ) ? $sub_heading_level : '3';
    $copy_modifier        = ( !empty($copy_modifier) ) ? $copy_modifier : '';
    $cta_modifier         = ( !empty($cta_modifier) ) ? $cta_modifier : '';
?>

<?php if( !empty($heading) && !empty($copy) ) : ?>
    <section class="split-leader <?= esc_attr($band); ?>">
        <div class="container">

            <div class="grid <?= esc_attr($grid_modifier); ?>">
                <?php if( !empty($heading) ) : ?>
                    <div class="split-leader__column <?= esc_attr($grid_col); ?>">
                        <?php if( !empty($heading) ) : ?>
                            <header>
                                <h<?= esc_attr($heading_level); ?> class"split-leader__heading <?= esc_attr($heading_modifier); ?>">
                                    <?= esc_html($heading); ?>
                                </h<?= esc_attr($heading_level); ?>>
                            </header>

                            <?php if( !empty($sub_heading) ) : ?>
                                <h<?= esc_attr($sub_heading_level); ?> class"split-leader__sub-heading <?= esc_attr($sub_heading_modifier); ?>">
                                    <?= esc_html($sub_heading); ?>
                                </h<?= esc_attr($sub_heading_level); ?>>
                            <?php endif; ?>

                            <?php if( !empty($cta_link) && !empty($cta_text) ) : ?>
                                <a href="<?= esc_url($cta_link); ?>" class="split-leader__btn btn <?= esc_attr($cta_modifier); ?>">
                                    <?= esc_html($cta_text); ?>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if( !empty($copy) ) : ?>
                    <div class="split-leader__column <?= esc_attr($grid_col); ?>">
                        <div class="split-leader__copy <?= esc_attr($copy_modifier); ?> text-module">
                            <?= Utils\esc_textarea__($copy); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </section>
<?php endif; ?>
