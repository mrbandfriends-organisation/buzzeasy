<?php

/**
 * Template Name: Generic Content
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
            'heading'                   => 'heading--white',
            'subheading'                => 'heading--white',
            'copy'               		=> 'text--white',
        ]),
    ]); ?>
<?php endif ?>

<?php if ($post->field('content')->has()) : ?>
    <?= Utils\ob_load_template_part('templates/generic-content', [
        'fields'                        => new ValueCollection([
            'content'                   => $post->field('content'),
        ]),
        'modifiers'                     => new ValueCollection([
            'heading'                   => '',
        ]),
    ]); ?>
<?php endif ?>