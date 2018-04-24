<?php

/**
 * Template Name: Contact Us Template
 */

?>

<section class="page-hero lazyload text-center">
	<div class="container">
		<div class="page-hero__inner">
			<header>
				<h1 class="page-hero__heading heading--alpha">
					Contact Us
				</h1>
			</header>
			
			<h2 class="heading--charlie">
				Subheading
			</h2>
		</div>
	</div>
</section>

<section class="contact-us band">
	<div class="container container--reduced">
		<h2>Get in touch</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
		<form action="action_page.php">

			<label for="fname">First Name</label>
			<input type="text" id="fname" name="firstname" required>

			<label for="lname">Last Name</label>
			<input type="text" id="lname" name="lastname" required>

			<label for="subject">Subject</label>
			<textarea id="subject" name="subject" style="height:200px"></textarea>

			<input id="GDPR" type="checkbox" value="GDPR">
			<label for="GDPR">GDPR Compliant Opt-in</label>

			<input type="submit" value="Submit">

		</form>
	</div>
</section>