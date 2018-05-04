<?php

/**
 * Template Name: About Us Template
 */

use Buzzeasy\App\Utilities\Post;
use Buzzeasy\App\Utilities\ValueCollection;

use Roots\Sage\Utils;

$post = new Post;

?>

<?php if ($post->field('page_hero')->has()) : ?>
    <?= Utils\ob_load_template_part('templates/components/page-hero/page-hero', [
        'fields'                        => $post->field('page_hero'),
        'modifiers'                     => new ValueCollection([
			'hero'						=> 'page-hero--cover-center',
            'heading'                   => 'heading--white heading--highlight--blue',
            'copy'               		=> 'text--white',
        ]),
    ]); ?>
<?php endif ?>

<?php if ($post->field('vision')->has()) : ?>
    <?= Utils\ob_load_template_part('templates/partials/shared/split-feature', [
        'fields'                        => new ValueCollection([
			'heading'					=> $post->field('vision')->get('vision_heading'),
			'copy'					    => $post->field('vision')->get('vision_copy'),
		]),
        'modifiers'                     => new ValueCollection([
			'band'						=> 'band--red',
            'heading'                   => 'heading--bravo heading--white',
            'copy'               		=> 'text--white',
        ]),
    ]); ?>
<?php endif ?>

<?php if ($post->field('team_heading')->has() && $post->field('team_copy')->has() && $post->field('team_background_image')->has()) : ?>
    <?= Utils\ob_load_template_part('templates/partials/team', [
        'fields'                        => new ValueCollection([
			'heading'					=> $post->field('team_heading'),
			'copy'					    => $post->field('team_copy'),
			'background_image'			=> $post->field('team_background_image'),
		]),
        'modifiers'                     => new ValueCollection([
            'heading'                   => 'heading--bravo heading--white',
            'copy'               		=> 'text--white',
        ]),
    ]); ?>
<?php endif ?>

<?php if ($post->field('group')->has()) : ?>
    <?= Utils\ob_load_template_part('templates/partials/shared/split-feature', [
        'fields'                        => new ValueCollection([
			'heading'					=> $post->field('group')->get('group_heading'),
			'copy'					    => $post->field('group')->get('group_copy'),
		]),
        'modifiers'                     => new ValueCollection([
			'band'						=> 'band--green',
            'heading'                   => 'heading--bravo heading--white',
            'copy'               		=> 'text--white',
        ]),
    ]); ?>
<?php endif ?>

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