<?php

use Roots\Sage\Assets;
use Roots\Sage\Utils;
use Buzzeasy\App\Utilities\ValueCollection;

$service   = $service ?? new ValueCollection();

$modifiers = $modifiers ?? new ValueCollection();

$content = $service->get('excerpt_content');

?>

<?php if ( $service->title->has() && $content->get('service_cta_text')->has() && $content->get('service_icon')->has() ) : ?>

    <div class="gc m1-3 l1-5">

        <?= wp_get_attachment_image($content->get('service_icon')->get('id')->raw(), null, null, ['class' => 'service-logo']); ?>

        <h3 class="heading--charlie heading--green">
            <?= $service->title->escape('html'); ?>
        </h3>

        <p>
            <?= $content->get('service_excerpt_copy')->escape('html'); ?>
        </p>

        <a href="/services/#message" class="btn btn--blue">
            <?= $content->get('service_cta_text')->escape('html'); ?>
        </a>

    </div>

<? endif; ?>