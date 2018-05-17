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

$contact_centre_benefits      = $fields->get('contact_centre_benefits');
$contact_centre_benefits_list = $contact_centre_benefits->get('benefits_list');
$marketing_benefits           = $fields->get('marketing_benefits');
$marketing_benefits_list      = $marketing_benefits->get('benefits_list');

?>

<section class="benefits band band--100 band--light-grey">

    <?php
    if ( $contact_centre_benefits->get('benefits_heading')->has()
    && $contact_centre_benefits->get('benefits_image')->has()
    && $contact_centre_benefits_list->has()
    ) :
    ?>

        <?php 
        $bg_image_data = Assets\bg_image_data($contact_centre_benefits->get('benefits_image')->get('id')->raw());
        ?>

        <div class="container benefits__container band--green landmark">
            <div class="grid grid--no-gutter">

                <div class="gc s1-1 l1-2 benefits__header-container lazyload" data-bgset="<?= $bg_image_data ?>" data-sizes="(min-width: 400px) 600px, 100vw">

                    <h2 class="benefits__heading heading--bravo heading--white heading--highlight--green">
                        <?= $contact_centre_benefits->get('benefits_heading')->escape('html'); ?>
                    </h2>

                </div>

                <div class="gc s1-1 l1-2">
                    <div class="benefits__list-container">

                        <?php if( $contact_centre_benefits_list->has() ) : ?>
                            <ul class="benefits__list text--white">
                                <?php foreach( $contact_centre_benefits_list as $benefit ) : ?>
                                    <li class="benefits__list-item"><?= $benefit->get('benefit_item')->escape('html'); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>

    <?php endif; ?>

    <?php
    if ( $marketing_benefits->get('benefits_heading')->has()
    && $marketing_benefits->get('benefits_image')->has()
    && $marketing_benefits_list->has()
    ) :
    ?>

        <?php 
        $bg_image_data = Assets\bg_image_data($marketing_benefits->get('benefits_image')->get('id')->raw());
        ?>

        <div class="container benefits__container band--blue">
            <div class="grid grid--no-gutter grid--reversed--medium">

                <div class="gc s1-1 l1-2">
                    <div class="benefits__list-container">

                        <?php if( $marketing_benefits_list->has() ) : ?>
                            <ul class="benefits__list text--white">
                                <?php foreach( $marketing_benefits_list as $benefit ) : ?>
                                    <li class="benefits__list-item"><?= $benefit->get('benefit_item')->escape('html'); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="gc s1-1 l1-2 benefits__header-container lazyload" data-bgset="<?= $bg_image_data ?>" data-sizes="(min-width: 400px) 600px, 100vw">

                    <h2 class="benefits__heading heading--bravo heading--white heading--highlight--blue">
                        <?= $marketing_benefits->get('benefits_heading')->escape('html'); ?>
                    </h2>

                </div>
                
            </div>
        </div>

    <?php endif; ?>

</section>

