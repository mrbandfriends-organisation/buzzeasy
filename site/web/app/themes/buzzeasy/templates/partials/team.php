<?php
/**
 * PARTIAL: Journey
 * The user journey slice. Makes use of some carefully-positioned 'flourish' SVGs.
 * See flourishes.scss for more information.
 *
 * FIELDS:
 *     heading
 *     steps (REPEATER)
 *         step_number
 *         step_text
 *
 * MODIFIERS:
 *     heading     - ''
 *     step_number - ''
 *     copy        - ''
 */

use Roots\Sage\Assets;
use Roots\Sage\Utils;
use Buzzeasy\App\Utilities\ValueCollection;

$fields = $fields ?? new ValueCollection();

$bg_image_data = "";
$image = "";

// CONTENT
if ($fields->get('background_image')->has()) {
    $bg_image_data = Assets\bg_image_data($fields->get('background_image')->get('id')->raw());
    $image = wp_get_attachment_image($fields->get('background_image')->get('id')->raw(), null, null, ['class' => 'vh']);
}

$modifiers = $modifiers ?? new ValueCollection();

?>

<?php if ($fields->get('heading')->has() && $fields->get('copy')->has() && $fields->get('background_image')->has() ) : ?>

    <section class="team band band--100" data-bgset="<?= $bg_image_data ?>" data-sizes="100vw">
        <div class="container">
            <div class="grid">
                <div class="gc s1-1 l1-2">
                </div>
                <div class="gc s1-1 l1-2 team__copy-container">
                    <h2 class="<?= $modifiers->get('heading')->escape('attr'); ?>">
                        <?= $fields->get('heading')->escape('html'); ?>
                    </h2>

                    <p class="<?= $modifiers->get('copy')->escape('attr'); ?>">
                        <?= nl2br($fields->get('copy')->escape('html')); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>
