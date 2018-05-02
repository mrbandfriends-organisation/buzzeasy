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
			
			<h2 class="heading--bravo heading--white">
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
				<a href="/services/#message" class="btn btn--blue">Learn more</a>
			</div>
			<div class="gc m1-3 l1-5">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/svg/standalone/output/call.svg' ?>" class="service-icon">
				<h3 class="heading--charlie heading--green">Service Name</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
				<a href="/services/#call" class="btn btn--blue">Learn more</a>
			</div>
			<div class="gc m1-3 l1-5">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/svg/standalone/output/queue.svg' ?>" class="service-icon">
				<h3 class="heading--charlie heading--green">Service Name</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
				<a href="/services/#queue" class="btn btn--blue">Learn more</a>
			</div>
			<div class="gc m1-3 l1-5">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/svg/standalone/output/chat.svg' ?>" class="service-icon">
				<h3 class="heading--charlie heading--green">Service Name</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
				<a href="/services/#chat" class="btn btn--blue">Learn more</a>
			</div>
			<div class="gc m1-3 l1-5">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/svg/standalone/output/list.svg' ?>" class="service-icon">
				<h3 class="heading--charlie heading--green">Service Name</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
				<a href="/services/#list" class="btn btn--blue">Learn more</a>
			</div>
		</div>
	</div>
</section>

<?= Utils\ob_load_template_part('templates/components/cta-banner'); ?>

<section class="benefits">
	<div class="container container--extend">
		<div class="grid grid--half-gutter">
			<div class="gc s1-1 l1-2 benefits__contact-centre band band--100 band--blue">
				<h2 class="heading--bravo heading--green">Contact Centre Benefits</h2>
				<ul class="text--green">
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
					<li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
					<li>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</li>
				</ul>
			</div>
			<div class="gc s1-1 l1-2 benefits__marketing band band--100 band--green">
				<h2 class="heading--bravo heading--blue">Marketing Benefits</h2>
				<ul class="text--blue">
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
					<li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
					<li>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<section class="endorsements band band--100">
	<div class="container container--reduced landmark">
		<h2 class="heading--bravo landmark text-center">
			Who we've worked with
		</h2>

		<div class="grid grid--landmark-double">
			<div class="gc t1-2 m1-3 l1-5 gc-vmiddle text-center">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/images/logos/zen.png' ?>" class="client-logo">
			</div>
			<div class="gc t1-2 m1-3 l1-5 gc-vmiddle text-center">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/images/logos/mrb.jpg' ?>" class="client-logo">
			</div>
			<div class="gc t1-2 m1-3 l1-5 gc-vmiddle text-center">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/images/logos/zen.png' ?>" class="client-logo">
			</div>
			<div class="gc t1-2 m1-3 l1-5 gc-vmiddle text-center">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/images/logos/mrb.jpg' ?>" class="client-logo">
			</div>
			<div class="gc t1-2 m1-3 l1-5 gc-vmiddle text-center">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/images/logos/zen.png' ?>" class="client-logo">
			</div>
		</div>
	</div>
	
	<div class="container text-center">

		<div class="grid">
			<div class="gc m1-5 text-center"></div>
			<div class="gc m3-5 text-center">
				<p class="text--large">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
				<a href="/contact-us/" class="btn btn--primary">Call us</a>
			</div>
			<div class="gc m1-5 text-center"></div>
		</div>
	</div>
</section>