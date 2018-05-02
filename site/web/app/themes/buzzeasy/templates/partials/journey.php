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

$steps = $fields->get('steps');

?>

<?php if ($fields->get('heading')->has() && $steps->has() ) : ?>

    <section class="customer-journey band band--100 band--blue">
        <div class="container">

            <?php if ($fields->get('heading')->has()) : ?>
                    <h2 class="heading--bravo heading--white text-center landmark <?= esc_attr($modifiers->get('heading')->escape('attr')); ?>">
                        <?= $fields->get('heading')->escape('html'); ?>
                    </h2>
            <?php endif; ?>

            <div class="grid grid--flourishes grid--flourishes--top">
                <div class="gc m1-2 l1-3">
                </div>
                <div class="gc m1-2 l1-3 text-center">
                    <div class="flourish-container">
                        <img src="<?php echo esc_attr(get_stylesheet_directory_uri() .'/assets/svg/standalone/output/flourish-2.svg'); ?>" alt="" class="flourish" id="flourish-2">
                    </div>
                </div>
                <div class="gc m1-2 l1-3">
                </div>
            </div>

            <div class="grid grid--double-gutter grid--customer-journey">

                <?php foreach( $steps as $step ) : ?>

                    <div class="gc m1-2 l1-4 text-center">
                        <h3 class="heading--alpha <?= esc_attr($modifiers->get('step_number')->escape('attr')); ?>">
                            <?= $step->get('step_number')->escape('html'); ?>
                        </h3>
                        <p class="<?= esc_attr($modifiers->get('step_text')->escape('attr')); ?>">
                            <?= $step->get('step_text')->escape('html'); ?>
                        </p>
                    </div>

                <?php endforeach; ?>

            </div>

            <div class="grid grid--flourishes grid--flourishes--top">
                <div class="gc m1-2 l1-3 text-left">
                    <div class="flourish-container">
                        <img src="<?php echo esc_attr(get_stylesheet_directory_uri() .'/assets/svg/standalone/output/flourish-1.svg'); ?>" alt="" class="flourish" id="flourish-1">
                    </div>
                </div>
                <div class="gc m1-2 l1-3"></div>
                <div class="gc m1-2 l1-3 text-right">
                    <div class="flourish-container">
                        <img src="<?php echo esc_attr(get_stylesheet_directory_uri() .'/assets/svg/standalone/output/flourish-3.svg'); ?>" alt="" class="flourish" id="flourish-3">
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>
