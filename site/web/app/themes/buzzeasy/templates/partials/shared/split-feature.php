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

$modifiers = $modifiers ?? new ValueCollection();

?>

<?php if ( $fields->get('heading')->has() && $fields->get('copy')->has() ) : ?>

    <section class="band band--100 <?= $modifiers->get('band')->escape('attr'); ?>">
        <div class="container">
            <div class="grid">
                <div class="gc s1-1 l1-2">

                    <h2 class="<?= $modifiers->get('heading')->escape('attr'); ?>">
                        <?= $fields->get('heading')->escape('html'); ?>
                    </h2>

                    <p class="<?= $modifiers->get('copy')->escape('attr'); ?>">
                        <?= nl2br($fields->get('copy')->escape('html')); ?>
                    </p>
                    
                </div>
                <div class="gc s1-1 l1-2 gc--vmiddle">
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>

