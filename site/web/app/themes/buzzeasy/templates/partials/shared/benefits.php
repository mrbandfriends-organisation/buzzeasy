<?php
/**
 * PARTIAL: Benefits
 *
 * FIELDS:
 *     benefits
 *     benefits_split (REPEATER)
 *         heading
 *         benefits_list (REPEATER)
 *             benefit
 *
 * MODIFIERS:
 *     heading - 'heading--white'
 *     buttons - 'btn--primary'
 */

use Roots\Sage\Assets;
use Roots\Sage\Utils;
use Buzzeasy\App\Utilities\ValueCollection;

$fields = $fields ?? new ValueCollection();

$modifiers = $modifiers ?? new ValueCollection();

$contact_centre_benefits = $fields->get('contact_centre_benefits');
$marketing_benefits      = $fields->get('marketing_benefits');

?>

<?php if ( $contact_centre_benefits->has() && $marketing_benefits->has() ) : ?>

    <section class="benefits">
        <div class="container container--extend">
            <div class="grid grid--half-gutter">

                    <div class="gc s1-1 l1-2 benefits__contact-centre band band--100 band--blue">
                        <h2 class="heading--bravo heading--green"></h2>
                        <ul class="text--green">
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                            <li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                            <li>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</li>
                        </ul>
                    </div>


                    <div class="gc s1-1 l1-2 benefits__marketing band band--100 band--green">
                        <h2 class="heading--bravo heading--blue">Marketing Benefits</h2>
                        <ul class="text--blue">
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                            <li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                            <li>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</li>
                        </ul>
                    </div>
            
            </div>
        </div>
    </section>

<?php endif; ?>

