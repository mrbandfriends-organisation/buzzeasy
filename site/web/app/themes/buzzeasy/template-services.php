<?php

/**
 * Template Name: Services Template
 */

use Buzzeasy\App\Utilities\Post;
use Buzzeasy\App\PostTypes\Service;
use Buzzeasy\App\Utilities\ValueCollection;

use Roots\Sage\Utils;

$post = new Post;

$services = Service::orderBy('post_title', 'ASC')->get();

?>

<?php if ($post->field('page_hero')->has()) : ?>
    <?= Utils\ob_load_template_part('templates/components/page-hero/page-hero', [
        'fields'                        => $post->field('page_hero'),
        'modifiers'                     => new ValueCollection([
			'hero'						=> 'page-hero--cover-center',
            'heading'                   => 'heading--blue heading--highlight--white',
            'subheading'                => 'heading--white',
            'copy'               		=> 'text--white',
        ]),
    ]); ?>
<?php endif ?>

<?= Utils\ob_load_template_part('templates/components/services/listing', [
	'services'						    => $services,
]); ?>

<?php if ($post->field('integrations_group')->has()) : ?>
	<?= Utils\ob_load_template_part('templates/partials/integrations', [
		'fields'						    => $post->field('integrations_group'),
		'modifiers'							=> new ValueCollection([
			'heading'						=> 'heading--bravo',
		]),
	]); ?>
<?php endif; ?>

<section class="case-studies band band--blue">
	<div class="container">

			<div class="carousel-container">
				<div class="carousel js-carousel service-carousel">
					<div class="carousel__slide">
						<div class="grid">
							<div class="gc s1-1 m1-2 gc--vmiddle text-center">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/geomant.png" alt="Geomant">
							</div>
							<div class="gc s1-1 m1-2">
								<h3 class="heading--bravo heading--white">Geomant</h3>
								<h3 class="heading--charlie heading--white">+50% customer satisfaction</h3>
								<p class="text--white">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
							</div>
						</div>
					</div>
					<div class="carousel__slide">
						<div class="grid">
							<div class="gc s1-1 m1-2 gc--vmiddle text-center">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/geomant.png" alt="Geomant">
							</div>
							<div class="gc s1-1 m1-2">
								<h3 class="heading--bravo heading--white">Geomant</h3>
								<h3 class="heading--charlie heading--white">+50% customer satisfaction</h3>
								<p class="text--white">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
							</div>
						</div>
					</div>
					<div class="carousel__slide">
						<div class="grid">
							<div class="gc s1-1 m1-2 gc--vmiddle text-center">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/geomant.png" alt="Geomant">
							</div>
							<div class="gc s1-1 m1-2">
								<h3 class="heading--bravo heading--white">Geomant</h3>
								<h3 class="heading--charlie heading--white">+50% customer satisfaction</h3>
								<p class="text--white">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
							</div>
						</div>
					</div>
				</div>
			</div>

	</div>
</section>

<?php if ($post->field('callout')->has()) : ?>
    <?= Utils\ob_load_template_part('templates/partials/shared/callout', [
        'fields'                        => $post->field('callout'),
        'modifiers'                     => new ValueCollection([
			'background'				=> 'page-hero--cover-bottom',
            'heading'                   => 'heading--yellow heading--highlight--red',
            'button'                 	=> 'btn--red',
        ]),
    ]); ?>
<?php endif ?>