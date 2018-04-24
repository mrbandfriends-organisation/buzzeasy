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
	<div class="container">
		<form action="action_page.php">

			<label for="fname">First Name</label>
			<input type="text" id="fname" name="firstname" placeholder="Your name..">

			<label for="lname">Last Name</label>
			<input type="text" id="lname" name="lastname" placeholder="Your last name..">

			<label for="country">Country</label>
			<select id="country" name="country">
			<option value="australia">Australia</option>
			<option value="canada">Canada</option>
			<option value="usa">USA</option>
			</select>

			<label for="subject">Subject</label>
			<textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

			<input type="submit" value="Submit">

		</form>
	</div>
</section>