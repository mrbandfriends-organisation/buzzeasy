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

$steps = $fields->get('journey_steps');

?>

<?php if ($fields->get('journey_heading')->has() && $steps->has() ) : ?>

    <section class="customer-journey band band--100 band--blue">
        <div class="container">

            <?php if ($fields->get('journey_heading')->has()) : ?>
                    <h2 class="heading--bravo heading--white text-center landmark <?= $modifiers->get('heading')->escape('attr'); ?>">
                        <?= $fields->get('journey_heading')->escape('html'); ?>
                    </h2>
            <?php endif; ?>

            <div class="grid grid--flourishes grid--flourishes--top">
                <div class="gc m1-2 l1-3">
                </div>
                <div class="gc m1-2 l1-3 text-center">
                    <div class="flourish-container">
                    <svg id="flourish-2" data-name="flourish 2" class="flourish" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150.7 58"><style>.st0{fill:none;stroke:gold;stroke-width:4.72;stroke-linecap:round;stroke-miterlimit:10}</style><title>Icons and flourishes</title><path class="st0" d="M2.1 55.1c17-35.9 32.5-44.8 32.5-44.8 4.2-2.8 11.2-7.8 20.7-7.8 14.8 0 24.2 11 24.2 11 4.4 4.5 4.4 11.8 0 16.3-4.5 4.5-11.9 4.6-16.5.1s-4.6-11.9-.1-16.4c.9-.9 1.8-1.8 2.8-2.7C68 9 70.4 7.4 72.9 5.9c4.3-2.2 9.1-3.4 14-3.5 9.5 0 16.8 4.6 20.8 7.8 0 0 22.2 19.8 40.4 45"/></svg>
                    </div>
                </div>
                <div class="gc m1-2 l1-3">
                </div>
            </div>

            <div class="grid grid--double-gutter grid--landmark grid--customer-journey">

                <?php foreach( $steps as $step ) : ?>

                    <div class="gc m1-2 l1-4 text-center">
                        <h3 class="heading--bravo journey__step__heading <?= $modifiers->get('step_number')->escape('attr'); ?>">
                            <?= $step->get('step_number')->escape('html'); ?>
                        </h3>
                        <p class="journey__step__copy <?= $modifiers->get('step_text')->escape('attr'); ?>">
                            <?= $step->get('step_text')->escape('html'); ?>
                        </p>
                    </div>

                <?php endforeach; ?>

            </div>

            <div class="grid grid--flourishes grid--flourishes--top">
                <div class="gc m1-2 l1-3 text-left">
                    <div class="flourish-container">
                        <svg id="flourish-1" data-name="flourish 1" class="flourish" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.82 35.56"><defs><style>.cls-1{fill:none;stroke:gold;stroke-linecap:round;stroke-miterlimit:10;stroke-width:4.72px;}</style></defs><title>Icons and flourishes</title><path class="cls-1" d="M2.36,25.59c4,3.2,11.31,7.7,20.85,7.61a31.16,31.16,0,0,0,14-3.57,59.42,59.42,0,0,0,7.22-4.89,27.41,27.41,0,0,0,2.74-2.68,11.63,11.63,0,1,0-16.61.11h0S40.06,33,54.82,32.9h0c9.48-.09,16.7-4.68,20.64-8"/></svg>
                    </div>
                </div>

                <div class="gc m1-2 l1-3 text-center">
                </div>

                <div class="gc m1-2 l1-3 text-right">
                    <div class="flourish-container">
                        <svg id="flourish-3" data-name="flourish 3" class="flourish" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 142.23 40.91"><defs><style>.cls-1{fill:none;stroke:gold;stroke-linecap:round;stroke-miterlimit:10;stroke-width:4.91px;}</style></defs><title>Icons and flourishes</title><path class="cls-1" d="M2.46,2.46s71.53,81,137.32,0"/></svg>
                    </div>
                </div>
            </div>

            <?php if ( $fields->get('journey_button_link')->has() && $fields->get('journey_button_text')->has() ) : ?>

                <div class="text-center band band--no-bottom">
                    <a href="<?= $fields->get('journey_button_link')->escape('html'); ?>" class="btn btn--white">
                        <?= $fields->get('journey_button_text')->escape('html'); ?>
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </section>

<?php endif; ?>
