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
        <div class="container container--reduced landmark">

            <h2 class="heading--bravo landmark text-center <?= $modifiers->get('heading')->escape('attr'); ?>">
                <?= $fields->get('wwww_heading')->escape('html'); ?>
            </h2>

            <div class="grid grid--landmark-double">

                <?php foreach($logos as $logo) : ?>
                    <div class="gc t1-2 m1-3 l1-5 gc-vmiddle text-center">
                        <?php if ($logo->get('wwww_logo')->has()) : ?>

                            <?= wp_get_attachment_image($logo->get('wwww_logo')->get('id')->raw(), null, null, ['class' => 'client-logo']); ?>

                        <?php endif ?>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
        
        <div class="container text-center">
            <div class="grid">
                <div class="gc m1-5 text-center"></div>

                <div class="gc m3-5 text-center">

                    <?php if ( $fields->get('wwww_subheading')->has() ) : ?>

                        <p class="<?= $modifiers->get('subheading')->escape('attr'); ?>">
                            <?= $fields->get('wwww_subheading')->escape('html'); ?>
                        </p>

                    <?php endif; ?>

                    <?php if ( $fields->get('wwww_button_link')->has() && $fields->get('wwww_button_text')->has() ) : ?>

                        <a href="<?= $fields->get('wwww_button_link')->escape('html'); ?>" class="btn <?= $modifiers->get('button')->escape('attr'); ?>">
                            <?= $fields->get('wwww_button_text')->escape('html'); ?>
                        </a>

                    <?php endif; ?>

                </div>

                <div class="gc m1-5 text-center"></div>
            </div>
        </div>
    </section>

<?php endif; ?>

