<?php
    use Roots\Sage\Assets;
    use Roots\Sage\Extras;
    use Roots\Sage\Utils;


    // CONTENT
    $slides = ( !empty($slides) ? $slides : null );
?>

<?php if (!empty($slides)): ?>
    <div class="carousel-container">
        <div class="carousel carousel--full-height js-carousel">

            <?php foreach ($slides as $slide): ?>
                <?php
                    $image_id   = (!empty($slide['carousel_image']['id'])) ? $slide['carousel_image']['id'] : null;
                    $image_data = ( !empty($image_id) ) ? Assets\bg_image_data($image_id) : null;
                ?>

                <?php if (!empty($image_data)): ?>
                    <div class="carousel__slide lazyload" data-bgset="<?= esc_attr($image_data); ?>">
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>
<?php endif; ?>
