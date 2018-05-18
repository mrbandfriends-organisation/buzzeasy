<?php
/**
 * PARTIAL: Page Hero
 *
 * FIELDS:
 *     hero_background_image
 *     hero_background_colour
 *     heading
 *     copy
 *     optional_ctas
 *
 * MODIFIERS:
 *     heading     - ''
 *     sub_heading - ''
 */

use Roots\Sage\Assets;
use Roots\Sage\Utils;
use Buzzeasy\App\Utilities\ValueCollection;

$fields = $fields ?? new ValueCollection();

$bg_image_data = "";
$image = "";
$smooth_scroll_class = "";

// CONTENT
if ($fields->get('hero_background_image')->has()) {
    $bg_image_data = Assets\bg_image_data($fields->get('hero_background_image')->get('id')->raw());
    $image = wp_get_attachment_image($fields->get('hero_background_image')->get('id')->raw(), null, null, ['class' => 'vh']);
}

$modifiers = $modifiers ?? new ValueCollection();

?>

<?php if ($fields->get('heading')->has() || $fields->get('subheading')->has()) : ?>
    <section class="page-hero  lazyload <?= $modifiers->get('hero')->escape('attr'); ?>" style="background-color: <?= $fields->get('hero_background_colour')->default('#008484')->escape('attr'); ?>;" data-bgset="<?= $bg_image_data ?>" data-sizes="100vw">
        <?php if (0): ?>
        <?= $image ?>
        <?php endif ?>
        <div class="page-hero__gradient"></div>
        <div class="container">

            <?php if ($fields->get('heading')->has() || $fields->get('copy')->has()) : ?>
                <div class="page-hero__inner">

                    <?php if ( !( $fields->get('use_logo')->has() ) ) : ?>
                    <!-- If we aren't using the logo (i.e. for the homepage) print the h1 instead. -->

                        <?php if ($fields->get('heading')->has()) : ?>
                                <h1 class="page-hero__heading heading--uppercase heading--alpha <?= $modifiers->get('heading')->escape('attr'); ?>">
                                    <?= $fields->get('heading')->escape('html'); ?>
                                </h1>
                        <?php endif; ?>

                    <?php else : ?>

                        <h1 class="vh">
                            Buzzeasy 
                        </h1>
                        <?= Utils\ob_load_template_part('templates/partials/site-logo-primary.php'); ?>

                    <?php endif; ?>

                    <?php if ($fields->get('subheading')->has()) : ?>
                            <h2 class="page-hero__heading heading--uppercase heading--bravo <?= $modifiers->get('subheading')->escape('attr'); ?>">
                                <?= $fields->get('subheading')->escape('html'); ?>
                            </h2>
                    <?php endif; ?>

                    <?php if ($fields->get('copy')->has()) : ?>
                        <p class="page-hero__copy text--large <?= $modifiers->get('copy')->escape('attr'); ?>">
                            <?= $fields->get('copy')->escape('textarea'); ?>
                        </p>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (!empty($additional_content)) : ?>
                    <?= $additional_content ?>
                <?php endif; ?>

                <?php if ($fields->get('optional_ctas')->has()) : ?>
                    <div class="btn-container band band--no-bottom">

                        <?php foreach ($fields->get('optional_ctas') as $optional_cta) : ?>

                            <?php if(stripos($optional_cta->get('cta_url')->escape('url'), '#') !== false ): ?>
                                <?php $smooth_scroll_class = 'js-smooth-scroll'; ?>
                            <?php endif; ?>

                            <a class="btn btn--secondary-inverted page-hero__cta <?= $smooth_scroll_class ?>" href="<?= $optional_cta->get('cta_url')->escape('url'); ?>">
                                <?= $optional_cta->get('cta_text')->escape('html'); ?>
                            </a>
                        <?php endforeach; ?>

                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
<?php endif; ?>
