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

// CONTENT
if ($fields->get('callout_background_image')->has()) {
    $bg_image_data = Assets\bg_image_data($fields->get('callout_background_image')->get('id')->raw());
    $image = wp_get_attachment_image($fields->get('callout_background_image')->get('id')->raw(), null, null, ['class' => 'vh']);
}

$modifiers = $modifiers ?? new ValueCollection();

?>

<?php if ( $fields->get('callout_heading')->has() ) : ?>
    <section class="cta-banner band band--100 lazyload <?= $modifiers->get('background')->escape('attr'); ?>" data-bgset="<?= $bg_image_data ?>" data-sizes="100vw">
        <div class="container band band--100">

            <?php if ( $fields->get('callout_heading')->has() ) : ?>

                <div class="grid">
                    <div class="gc s1-1 l3-4">

                        <h2 class="heading--alpha landmark--half <?= esc_attr($modifiers->get('heading')->escape('attr')); ?>">
                            <?= nl2br($fields->get('callout_heading')->escape('textarea')); ?>
                        </h2> <br> <br>

                        <?php if ( $fields->get('callout_button_text')->has() && $fields->get('callout_button_link')->has() ) : ?>

                            <a href="<?= $fields->get('callout_button_link')->escape('html'); ?>" class="btn <?= esc_attr($modifiers->get('button')->escape('attr')); ?>">
                                <?= $fields->get('callout_button_text')->escape('html'); ?>
                            </a>

                        <?php endif; ?>

                    </div>
                    <div class="gc s1-1 l1-4">
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </section>
<?php endif; ?>

