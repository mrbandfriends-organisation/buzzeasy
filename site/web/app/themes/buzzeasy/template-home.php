<?php

/**
 * Template Name: Homepage Template
 */

use Roots\Sage\Utils;

?>

<section class="page-hero lazyload">
	<div class="container">
		<div class="page-hero__inner">
			<header>
				<h1 class="vh">
					Buzzeasy
				</h1>
				<img src="<?php echo esc_attr(get_stylesheet_directory_uri() .'/assets/svg/standalone/output/logo-primary.svg'); ?>" alt="<?php echo esc_attr(bloginfo('name'));?>">
			</header>
			
			<h2 class="heading--bravo">
				Cross-channel, not crossed wires.
			</h2>

			<p class="text--large text--white">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
			</p>
		</div>
	</div>
</section>

<section class="customer-journey band band--100 band--blue">
	<div class="container">
		<h2 class="heading--bravo heading--white text-center landmark">4 steps to lorem ipsum.</h2>

		<div class="grid grid--flourishes grid--flourishes--top">
			<div class="gc m1-2 l1-3">
			</div>
			<div class="gc m1-2 l1-3 text-center">
				<div class="flourish-container">
					<img src="<?php echo esc_attr(get_stylesheet_directory_uri() .'/assets/svg/standalone/output/flourish-2.svg'); ?>" alt="" class="flourish" id="flourish-2">
				</div>
			</div>
			<div class="gc m1-2 l1-3">
			</div>
		</div>

		<div class="grid grid--double-gutter grid--customer-journey">
			<div class="gc m1-2 l1-4 text-center">
				<h3 class="heading--alpha">1.</h3>
				<p class="text--white">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
			</div>
			<div class="gc m1-2 l1-4 text-center">
				<h3 class="heading--alpha">2.</h3>
				<p class="text--white">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
			</div>
			<div class="gc m1-2 l1-4 text-center">
				<h3 class="heading--alpha">3.</h3>
				<p class="text--white">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
			</div>
			<div class="gc m1-2 l1-4 text-center">
				<h3 class="heading--alpha">4.</h3>
				<p class="text--white">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
			</div>
		</div>

		<div class="grid grid--flourishes grid--flourishes--top">
			<div class="gc m1-2 l1-3 text-left">
				<div class="flourish-container">
					<img src="<?php echo esc_attr(get_stylesheet_directory_uri() .'/assets/svg/standalone/output/flourish-1.svg'); ?>" alt="" class="flourish" id="flourish-1">
				</div>
			</div>
			<div class="gc m1-2 l1-3"></div>
			<div class="gc m1-2 l1-3 text-right">
				<div class="flourish-container">
					<img src="<?php echo esc_attr(get_stylesheet_directory_uri() .'/assets/svg/standalone/output/flourish-3.svg'); ?>" alt="" class="flourish" id="flourish-3">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="services band band--100 band--white">
	<div class="container text-center">
		<h2 class="heading--bravo heading--green landmark">Services</h2>
		<div class="grid grid--landmark-double">
			<div class="gc m1-3 l1-5">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/svg/standalone/output/message.svg' ?>" class="service-icon">
				<h3 class="heading--charlie heading--green">Service Name</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
				<a href="/services/" class="btn btn--blue">Learn more</a>
			</div>
			<div class="gc m1-3 l1-5">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/svg/standalone/output/call.svg' ?>" class="service-icon">
				<h3 class="heading--charlie heading--green">Service Name</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
				<a href="/services/" class="btn btn--blue">Learn more</a>
			</div>
			<div class="gc m1-3 l1-5">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/svg/standalone/output/queue.svg' ?>" class="service-icon">
				<h3 class="heading--charlie heading--green">Service Name</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
				<a href="/services/" class="btn btn--blue">Learn more</a>
			</div>
			<div class="gc m1-3 l1-5">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/svg/standalone/output/chat.svg' ?>" class="service-icon">
				<h3 class="heading--charlie heading--green">Service Name</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
				<a href="/services/" class="btn btn--blue">Learn more</a>
			</div>
			<div class="gc m1-3 l1-5">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/svg/standalone/output/list.svg' ?>" class="service-icon">
				<h3 class="heading--charlie heading--green">Service Name</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
				<a href="/services/" class="btn btn--blue">Learn more</a>
			</div>
		</div>
	</div>
</section>

<?= Utils\ob_load_template_part('templates/components/cta-banner'); ?>

<section class="benefits band band--100 band--green">
	<div class="container">
		<div class="grid">
			<div class="gc s1-1 l1-2">
				<h2 class="heading--bravo heading--white">Contact Centre Benefits</h2>
				<ul class="text--white">
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
					<li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
					<li>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</li>
				</ul>
			</div>
			<div class="gc s1-1 l1-2">
				<h2 class="heading--bravo heading--white">Marketing Benefits</h2>
				<ul class="text--white">
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
					<li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
					<li>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<section class="endorsements band band--100">
	<div class="container landmark">
		<h2 class="heading--bravo landmark text-center">
			Who we've worked with
		</h2>

		<div class="grid">
			<div class="gc m1-3 l1-5 text-center"><img src="https://via.placeholder.com/150x50" alt="" class="endorsement-icon"></div>
			<div class="gc m1-3 l1-5 text-center"><img src="https://via.placeholder.com/150x50" alt="" class="endorsement-icon"></div>
			<div class="gc m1-3 l1-5 text-center"><img src="https://via.placeholder.com/150x50" alt="" class="endorsement-icon"></div>
			<div class="gc m1-3 l1-5 text-center"><img src="https://via.placeholder.com/150x50" alt="" class="endorsement-icon"></div>
			<div class="gc m1-3 l1-5 text-center"><img src="https://via.placeholder.com/150x50" alt="" class="endorsement-icon"></div>
		</div>
	</div>
	
	<div class="container text-center">
		<p class="text--large">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
		<a href="/contact-us/" class="btn btn--primary">Call us</a>
	</div>
</section>