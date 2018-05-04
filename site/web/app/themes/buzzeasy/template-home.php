<?php

/**
 * Template Name: Homepage Template
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
            'heading'                   => 'heading--white',
            'subheading'                => 'heading--white',
            'copy'               		=> 'text--white',
        ]),
    ]); ?>
<?php endif ?>

<?php if ($post->field('journey')->has()) : ?>
    <?= Utils\ob_load_template_part('templates/partials/journey', [
        'fields'                        => $post->field('journey'),
        'modifiers'                     => new ValueCollection([
            'heading'                   => 'heading--white',
            'step_number'               => 'heading--white',
            'step_text'                 => 'text--white',
        ]),
    ]); ?>
<?php endif ?>

<?php if ($post->field('services_overview')->has()) : ?>
    <?= Utils\ob_load_template_part('templates/components/services-overview/listing', [
		'fields'                        => $post->field('services_overview'),
		'services'						=> $services,
        'modifiers'                     => new ValueCollection([
			'heading'                   => 'heading--green',
			'subheading'				=> 'heading--green',
            'button'    	           	=> 'btn--blue',
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

<?php if ($post->field('benefits')->has()) : ?>
    <?= Utils\ob_load_template_part('templates/partials/shared/benefits', [
        'fields'                        => $post->field('benefits'),
    ]); ?>
<?php endif ?>

<?php if ($post->field('who_weve_worked_with')->has()) : ?>
    <?= Utils\ob_load_template_part('templates/partials/shared/who-weve-worked-with', [
        'fields'                        => $post->field('who_weve_worked_with'),
        'modifiers'                     => new ValueCollection([
			'subheading'                => 'text--large',
			'button'					=> 'btn--primary',
        ]),
    ]); ?>
<?php endif ?>