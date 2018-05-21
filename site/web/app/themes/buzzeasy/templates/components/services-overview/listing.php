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

$modifiers = $modifiers ?? new ValueCollection();

$heading = $fields->get('services_heading');

?>

<?php if ($heading->has() ) : ?>

    <section class="services-overview band band--100 band--white">
        <div class="container text-center">

            <h2 class="heading--bravo landmark <?= $modifiers->get('heading')->escape('attr'); ?>">
                <?= $heading->escape('html'); ?>
            </h2>

            <div class="grid grid--landmark-double">

                <?php foreach ( $services as $service ) : ?>
    
                    <?= Utils\ob_load_template_part('templates/components/services-overview/single', [
                        'service'                       => $service,
                        'modifiers'                     => $modifiers,
                    ]); ?>

                <?php endforeach; ?>

            </div>
        </div>
    </section>

<?php endif; ?>
