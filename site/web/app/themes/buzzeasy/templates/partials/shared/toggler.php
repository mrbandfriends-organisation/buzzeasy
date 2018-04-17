<?php
    use Roots\Sage\Utils;


    // CONTENT
    $content = $content ?? '';


    // MODIFIERS
    $modifier = $modifier ?? null;
?>


<?php if( !empty($content) ) : ?>
    <div class="toggler toggler--out-flow <?= esc_attr($modifier); ?>">
        <button class="toggler__trigger js-toggle">
            Click Me
        </button>

        <?php if( !empty($content) ) : ?>
            <div class="toggler__content js-toggle-target">
                <?= Utils\esc_textarea__($content); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
