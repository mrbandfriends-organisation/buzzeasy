<?php
/**
 * PARTIAL: Integrations
 *
 * FIELDS:
 *     integration_heading
 *     integration_copy
 *     integration (REPEATER)
 *         integration_logo
 *
 * MODIFIERS:
 *     heading     - ''
 *     container   - ''
 */

use Roots\Sage\Assets;
use Roots\Sage\Utils;
use Buzzeasy\App\Utilities\ValueCollection;

$fields = $fields ?? new ValueCollection();

$modifiers = $modifiers ?? new ValueCollection();

$integrations = $fields->get('integrations');

?>

<?php if ( $fields->has('integrations_heading') && $fields->has('integrations_copy') && $fields->has('integrations') ) : ?>
    <section class="integration band band--100 <?= $modifiers->get('container')->escape('attr'); ?>">
        <div class="container">
            <div class="grid">
                <div class="gc s1-1 l1-2">

                    <h2 class="<?= $modifiers->get('heading')->escape('attr'); ?>">
                        <?= $fields->get('integrations_heading')->escape('html'); ?>
                    </h2>
                    
                    <p class="<?= $modifiers->get('copy')->escape('attr'); ?>">
                        <?= $fields->get('integrations_copy')->escape('html'); ?>
                    </p>

                </div>
                <div class="gc s1-1 l1-2"></div>
            </div>
            <div class="grid grid--landmark-double">

                <?php foreach( $integrations as $integration ) : ?>

                        <?php if ($integration->get('integration_logo')->has()) : ?>

                            <div class="gc gc--vmiddle m1-3 l1-5 text-center">

                                <?= Assets\lazyload_image($integration->get('integration_logo')->get('id')->raw(), [
                                    'class'   => 'integrations__logo',
                                ]) ?>

                            </div>

                        <?php endif ?>

                <?php endforeach; ?>

            </div>
        </div>
    </section>
<?php endif; ?>