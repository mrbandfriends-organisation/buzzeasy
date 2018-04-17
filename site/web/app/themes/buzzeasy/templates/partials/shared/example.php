<?php 
	
	// Define Variables 

	$title       =  '$value';
	$subtitle    =  '$value';
	$description =  '$value';


?>

<?php if (!empty($title) || !empty($description) ): ?>

	<div class="container">
		<h2>
			<?= esc_html($title); ?>
			<span><?= esc_html($subtitle); ?></span>

		</h2>

		<p><?= esc_html($desciption); ?></p>
	</div>
	
<?php endif; ?>