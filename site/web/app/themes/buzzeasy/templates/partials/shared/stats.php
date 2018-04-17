<?php
    use Roots\Sage\Utils;

    // CONTENT
    $stat    = ( !empty($stat) ) ? $stat : [];


    // MODIFIERS
    $modifier = ( !empty($modifier) ) ? $modifier : '';
?>


<?php if(!empty($stat)): ?>
    <?php
        // CONTENT
        $stat_figure = ( !empty($stat['figure']) ) ? $stat['figure'] : '';
        $stat_label   = ( !empty($stat['label']) ) ? $stat['label'] : '';
    ?>

    <?php if( !empty($stat_figure) && !empty($stat_label) ) : ?>
        <div class="stat <?= esc_attr($modifier); ?>">
            <?php if( !empty($stat_figure) ) : ?>
                <strong class="stat__figure">
                    <?= esc_html($stat_figure); ?>
                </strong>
            <?php endif; ?>

            <?php if( !empty($stat_label) ) : ?>
                <span class="stat__label">
                    <?= esc_html($stat_label); ?>
                </span>
            <?php endif; ?>
        </div>
    <?php endif; ?>

<?php endif; ?>
