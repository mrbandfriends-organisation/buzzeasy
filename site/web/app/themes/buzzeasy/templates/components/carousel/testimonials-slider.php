<?php
/**
 * Component: Testimonials Slider
 *
 * FIELDS:
 *     testimonials (REPEATER)
 *         testimonial_logo
 *         testimonial_name
 *         testimonial_statistic
 *         testimonial_copy
 * 
 */

use Roots\Sage\Assets;
use Roots\Sage\Utils;
use Buzzeasy\App\Utilities\ValueCollection;

$fields = $fields ?? new ValueCollection();

$modifiers = $modifiers ?? new ValueCollection();

$testimonials = $fields->get('testimonials');

?>

<?php if( $testimonials->has() ) : ?>
    <section class="case-studies band <?= $modifiers->get('section')->escape('attr'); ?>">
        <div class="container">
            <div class="carousel-container">
                <div class="carousel js-carousel testimonial-carousel">

                    <?php foreach($testimonials as $testimonial) : ?>
                        <?php
                        // Check for logo, name and copy. The statistic field is optional, so we can continue without it.
                        if(  $testimonial->get('testimonial_logo')->has() && $testimonial->get('testimonial_name')->has() && $testimonial->get('testimonial_copy')->has()  ) :
                        ?>

                            <div class="carousel__slide">
                                <div class="grid grid--vmiddle">

                                    <div class="gc s1-1 m1-3 gc--vmiddle text-center">

                                        <?php
                                        $logo_id = $testimonial->get('testimonial_logo')->get('id')->raw();
                                        echo Assets\lazyload_image($logo_id, [
                                            'class'   => 'testimonial__logo',
                                        ]);
                                        ?>

                                    </div>

                                    <div class="gc s1-1 m2-3">

                                        <h3 class="heading--bravo heading--white">
                                            <?= $testimonial->get('testimonial_name')->escape('html'); ?>
                                        </h3>
                                        
                                        <?php if ( $testimonial->get('testimonial_statistic')->has() ) : ?>
                                            <h4 class="heading--charlie heading--white">
                                                <?= $testimonial->get('testimonial_statistic')->escape('html'); ?>
                                            </h4>
                                        <?php endif; ?>

                                        <p class="text--white">
                                            <?= $testimonial->get('testimonial_copy')->escape('textarea'); ?>
                                        </p>

                                    </div>

                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>