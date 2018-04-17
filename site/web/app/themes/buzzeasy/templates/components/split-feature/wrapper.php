<?php
    use Roots\Sage\Utils;


    // CONTENT
    $features    = ( !empty($features) ) ? $features : null;


    // MODIFIERS
    $grid_column = ( !empty($grid_column) ) ? $grid_column : "m1-2";
?>


<?php if( !empty($features) ) : ?>
    <div class="split-feature-container">
        <div class="grid grid--no-gutter">


            <?php foreach ($features as $feature): ?>
                <?php
                    // CONTENT
                    $content  = ( !empty($feature['content']) ) ? $feature['content'] : null;
                    $modifier = ( !empty($feature['modifier']) ) ? $feature['modifier'] : null;
                ?>
                <?php if( !empty($content) ) : ?>
                    <div class="split-feature__column gc <?= esc_attr($grid_column); ?>">
                        <div class="split-feature <?= esc_attr($modifier); ?>">
                            <?= $content; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>


        </div>
    </div>
<?php endif; ?>
