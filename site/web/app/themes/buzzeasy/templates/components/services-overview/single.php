<?php

use Roots\Sage\Assets;
use Roots\Sage\Utils;
use Buzzeasy\App\Utilities\ValueCollection;

$service   = $service ?? new ValueCollection();

$modifiers = $modifiers ?? new ValueCollection();

$content = $service->get('excerpt_content');
$title   = $service->title;

?>

<?php if ( $title->has() && $content->has('service_cta_text') && $content->has('service_icon') ) : ?>

    <div class="gc m1-3 l1-5">
        <div class="service-overview__content">

            <div>

                <img class="service-overview__logo lazyload" data-src="<?= $content->get('service_icon')->get('url'); ?>" alt="<?= $title->escape('html'); ?>">

                <noscript>
                    <img class="service-overview__logo" src="<?= $content->get('service_icon')->get('url'); ?>" alt="<?= $title->escape('html'); ?>">
                </noscript>

                <h3 class="heading--charlie heading--green">
                    <?= $title->escape('html'); ?>
                </h3>

                <p class="service-overview__copy">
                    <?= $content->get('service_excerpt_copy')->escape('html'); ?>
                </p>
            </div>

            <div>
                <a href="/services/#<?= sanitize_title($title->escape('html')); ?>" class="btn btn--blue">
                    <?= $content->get('service_cta_text')->escape('html'); ?>
                </a>
            </div>

        </div>
    </div>

<? endif; ?>