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

$modifiers = $modifiers ?? new ValueCollection();

?>

<?php if ($services->has()) : ?>

    <section class="services-listing band band--100">
        <div class="container">

            <?php foreach ( $services as $service ) : ?>

                <?= Utils\ob_load_template_part('templates/components/services/single', [
                    'service'                       => $service,
                    'modifiers'                     => $modifiers,
                ]); ?>

            <?php endforeach; ?>

        </div>
    </section>

<?php endif; ?>
