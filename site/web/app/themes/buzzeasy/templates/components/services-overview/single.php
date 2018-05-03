<?php

use Roots\Sage\Assets;
use Roots\Sage\Utils;
use Buzzeasy\App\Utilities\ValueCollection;

$service   = $service ?? new ValueCollection();

$modifiers = $modifiers ?? new ValueCollection();

$content = $service->get('excerpt_content');
$title   = $service->title;

?>

<?php if ( $title->has() && $content->get('service_cta_text')->has() && $content->get('service_icon')->has() ) : ?>

    <div class="gc m1-3 l1-5">
        <div class="service-content">

            <div>
                <?= wp_get_attachment_image($content->get('service_icon')->get('id')->raw(), null, null, ['class' => 'service-logo']); ?>

                <h3 class="heading--charlie heading--green">
                    <?= $title->escape('html'); ?>
                </h3>

                <p>
                    <?= $content->get('service_excerpt_copy')->escape('html'); ?>
                </p>
            </div>

            <a href="/services/#<?= sanitize_title($title->escape('html')); ?>" class="btn btn--blue">
                <?= $content->get('service_cta_text')->escape('html'); ?>
            </a>

        </div>
    </div>

<? endif; ?>