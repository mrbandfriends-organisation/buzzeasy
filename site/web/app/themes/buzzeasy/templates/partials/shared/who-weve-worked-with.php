<?php
/**
 * PARTIAL: Benefits
 *
 * FIELDS:
 *     benefits
 *         contact_centre_benefits (REPEATER)
 *             heading
 *             benefits_list (REPEATER)
 *                 benefit_item
 *         marketing_benefits (REPEATER)
 *             heading
 *             benefits_list (REPEATER)
 *                 benefit_item
 * 
 */

use Roots\Sage\Assets;
use Roots\Sage\Utils;
use Buzzeasy\App\Utilities\ValueCollection;

$fields = $fields ?? new ValueCollection();

$modifiers = $modifiers ?? new ValueCollection();

$logos      = $fields->get('wwww_logos');

?>

<?php if ( $fields->get('wwww_heading')->has() ) : ?>

    <section class="endorsements band band--100">
        <div class="container container--reduced landmark text-center">

            <h2 class="heading--bravo landmark <?= $modifiers->get('heading')->escape('attr'); ?>">
                <?= $fields->get('wwww_heading')->escape('html'); ?>
            </h2>

            <?php if ( $fields->get('wwww_subheading')->has() ) : ?>

                <p class="landmark <?= $modifiers->get('subheading')->escape('attr'); ?>">
                    <?= $fields->get('wwww_subheading')->escape('html'); ?>
                </p>

            <?php endif; ?>

            <?php if ( $logos->has() ) : ?>
                <div class="grid grid--landmark grid--center">

                    <?php foreach($logos as $logo) : ?>
                        <?php if ($logo->get('wwww_logo')->has()) : ?>
                            <div class="gc t1-3 m1-5">

                                <?= Assets\lazyload_image($logo->get('wwww_logo')->get('id')->raw(), [
                                    'aspect_ratio' => 1/1,
                                    'class'   => 'endorsements__logo',
                                ]) ?>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>
            <?php endif; ?>

        </div>
        
        <div class="container text-center">

            <?php if ( $fields->get('wwww_button_link')->has() && $fields->get('wwww_button_text')->has() ) : ?>

                <button class="btn <?= $modifiers->get('button')->escape('attr'); ?>" data-micromodal-trigger="modal-1">
                    <?= $fields->get('wwww_button_text')->escape('html'); ?>
                </button>

            <?php endif; ?>
                
        </div>
    </section>

<?php endif; ?>

