<?php
/**
 * PARTIAL: Callout
 *
 * FIELDS:
 *     heading
 *     buttons
 *     background_image
 *
 * MODIFIERS:
 *     heading - 'heading--white'
 *     buttons - 'btn--primary'
 */

use Roots\Sage\Assets;
use Roots\Sage\Utils;
use Buzzeasy\App\Utilities\ValueCollection;

$fields = $fields ?? new ValueCollection();

$bg_image_data = "";
$image = "";
$smooth_scroll_class = "";

// CONTENT
if ($fields->get('background_image')->has()) {
    $bg_image_data = Assets\bg_image_data($fields->get('background_image')->get('id')->raw());
    $image = wp_get_attachment_image($fields->get('background_image')->get('id')->raw(), null, null, ['class' => 'vh']);
}

$modifiers = $modifiers ?? new ValueCollection();

$buttons = $fields->get('buttons');

?>

<?php if ( $fields->get('heading')->has() ) : ?>
    <section class="cta-banner band band--100" data-bgset="<?= $bg_image_data ?>" data-sizes="100vw">
        <div class="container band band--100">

            <?php if ( $fields->get('heading')->has() && $fields->get('buttons')->has() ) : ?>

                <div class="grid">
                    <div class="gc s1-1 l3-4">

                        <h2 class="heading--alpha landmark--half <?= esc_attr($modifiers->get('heading')->escape('attr')); ?>">
                            <?= nl2br($fields->get('heading')->escape('textarea')); ?>
                        </h2> <br> <br>

                        <?php foreach( $buttons as $button ) : ?>

                            <a href="<?= $button->get('button_url')->escape('html'); ?>" class="btn <?= esc_attr($modifiers->get('buttons')->escape('attr')); ?>">
                                <?= $button->get('button_text')->escape('html'); ?>
                            </a>

                        <?php endforeach; ?>

                    </div>
                    <div class="gc s1-1 l1-4">
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </section>
<?php endif; ?>

