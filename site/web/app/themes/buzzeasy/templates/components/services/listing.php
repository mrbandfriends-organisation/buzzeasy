<?php
/**
 * PARTIAL: Services Listing
 */

use Roots\Sage\Assets;
use Roots\Sage\Utils;
use Buzzeasy\App\Utilities\ValueCollection;

$services  = $services  ?? new ValueCollection();

?>

<?php if ($services->has()) : ?>

    <section class="services-listing band band--100">
        <div class="container">

            <?php foreach ( $services as $service ) : ?>

                <?= Utils\ob_load_template_part('templates/components/services/single', [
                    'service' => $service,
                ]); ?>

            <?php endforeach; ?>

        </div>
    </section>

<?php endif; ?>
