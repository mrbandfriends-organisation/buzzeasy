<?php

/**
 * Template Name: Example Inline Videos
 */

	use Roots\Sage\Utils;
?>

<div class="container">
	<h1>A YouTube video</h1>
	<?= Utils\ob_load_template_part('templates/components/video/inline', [
		'video_id' => 'rPu_d4SSOPk',
		'type' => 'youtube'
	]); ?>

	<h1>A Vimeo video</h1>
	<?= Utils\ob_load_template_part('templates/components/video/inline', [
		'video_id' => '225408543',
		'type' => 'vimeo'
	]); ?>

	<h1>A Source File video</h1>
	<?= Utils\ob_load_template_part('templates/components/video/inline', [
		'poster' => 'https://cdn.selz.com/plyr/1.5/View_From_A_Blue_Moon_Trailer-HD.jpg',
		'sources' => [
			array(
				'src' => 'https://cdn.selz.com/plyr/1.5/View_From_A_Blue_Moon_Trailer-HD.mp4',
				'type' => 'mp4'
			),
			array(
				'src' => 'https://cdn.selz.com/plyr/1.5/View_From_A_Blue_Moon_Trailer-HD.webm',
				'type' => 'webm'
			),
		]
	]); ?>
</div>


