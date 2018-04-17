<?php
    use Roots\Sage\Utils;

    // CONTENT
    $stats    = ( !empty($stats) ) ? $stats : [];


    // MODIFIERS
    $modifier  = ( !empty($modifier) ) ? $modifier : '';
    $grid_col  = ( !empty($grid_col) ) ? $grid_col : 's1-2';
    $container = ( !empty($container) ) ? $container : '';
?>


<?php if(!empty($stats)): ?>
    <?php if( !empty($container) ) : ?>
        <div class="<?= esc_attr($container); ?>">
    <?php endif; ?>


        <div class="grid grid--landmark">
            <?php foreach ($stats as $stat) : ?>
                <div class="gc <?= esc_attr($grid_col); ?>">
                    <?= Utils\ob_load_template_part("templates/partials/shared/stats", compact(
                        'stat',
                        'modifier'
                    )); ?>
                </div>
            <?php endforeach; ?>
        </div>

    <?php if( !empty($container) ) : ?>
        <div class="container"></div>
    <?php endif; ?>
<?php endif; ?>
