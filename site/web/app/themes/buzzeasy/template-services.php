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

<section class="service band band--light-grey" id="message">
	<div class="container">
		<div class="grid">
			<div class="gc s1-1 m1-4">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/svg/standalone/output/message--blue.svg' ?>" class="service-icon">
			</div>
			<div class="gc s1-1 m3-4">
				<h2 class="heading--bravo">Service Name</h2>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				</p>
				<ul>
					<li>Detail about the product</li>
					<li>Detail about the product</li>
					<li>Detail about the product</li>
				</ul>
				<button class="btn btn--primary">
					Service link
				</button>
			</div>
		</div>
	</div>
</section>

<section class="service band" id="call">
	<div class="container">
		<div class="grid">
			<div class="gc s1-1 m1-4">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/svg/standalone/output/call--blue.svg' ?>" class="service-icon">
			</div>
			<div class="gc s1-1 m3-4">
				<h2 class="heading--bravo">Service Name</h2>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				</p>
				<ul>
					<li>Detail about the product</li>
					<li>Detail about the product</li>
					<li>Detail about the product</li>
				</ul>
				<button class="btn btn--primary">
					Service link
				</button>
			</div>
		</div>
	</div>
</section>

<section class="service band band--light-grey" id="queue">
	<div class="container">
		<div class="grid">
			<div class="gc s1-1 m1-4">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/svg/standalone/output/queue--blue.svg' ?>" class="service-icon">
			</div>
			<div class="gc s1-1 m3-4">
				<h2 class="heading--bravo">Service Name</h2>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				</p>
				<ul>
					<li>Detail about the product</li>
					<li>Detail about the product</li>
					<li>Detail about the product</li>
				</ul>
				<button class="btn btn--primary">
					Service link
				</button>
			</div>
		</div>
	</div>
</section>

<section class="service band" id="chat">
	<div class="container">
		<div class="grid">
			<div class="gc s1-1 m1-4 text-center">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/svg/standalone/output/chat--blue.svg' ?>" class="service-icon">
			</div>
			<div class="gc s1-1 m3-4">
				<h2 class="heading--bravo">Service Name</h2>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				</p>
				<ul>
					<li>Detail about the product</li>
					<li>Detail about the product</li>
					<li>Detail about the product</li>
				</ul>
				<button class="btn btn--primary">
					Service link
				</button>
			</div>
		</div>
	</div>
</section>

<section class="service band band--light-grey" id="list">
	<div class="container">
		<div class="grid">
			<div class="gc s1-1 m1-4">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/svg/standalone/output/list--blue.svg' ?>" class="service-icon">
			</div>
			<div class="gc s1-1 m3-4">
				<h2 class="heading--bravo">Service Name</h2>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				</p>
				<ul>
					<li>Detail about the product</li>
					<li>Detail about the product</li>
					<li>Detail about the product</li>
				</ul>
				<button class="btn btn--primary">
					Service link
				</button>
			</div>
		</div>
	</div>
</section>

<section class="integration band">
	<div class="container">
		<div class="grid">
			<div class="gc s1-1 l1-2">
				<h2 class="heading--bravo">Integrations</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			</div>
			<div class="gc s1-1 l1-2"></div>
		</div>
		<div class="grid">
			<div class="gc m1-3 l1-5 text-center"><img src="https://via.placeholder.com/150x50" alt="" class="endorsement-icon"></div>
			<div class="gc m1-3 l1-5 text-center"><img src="https://via.placeholder.com/150x50" alt="" class="endorsement-icon"></div>
			<div class="gc m1-3 l1-5 text-center"><img src="https://via.placeholder.com/150x50" alt="" class="endorsement-icon"></div>
			<div class="gc m1-3 l1-5 text-center"><img src="https://via.placeholder.com/150x50" alt="" class="endorsement-icon"></div>
			<div class="gc m1-3 l1-5 text-center"><img src="https://via.placeholder.com/150x50" alt="" class="endorsement-icon"></div>
		</div>
	</div>
</section>

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

<?= Utils\ob_load_template_part('templates/partials/shared/callout'); ?>