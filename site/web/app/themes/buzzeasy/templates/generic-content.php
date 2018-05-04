<?php
/**
 * PARTIAL: Generic Content
 *
 * FIELDS:
 *     content
 *
 * MODIFIERS:
 *     heading     - ''
 */

use Roots\Sage\Assets;
use Roots\Sage\Utils;
use Buzzeasy\App\Utilities\ValueCollection;

$fields = $fields ?? new ValueCollection();

$modifiers = $modifiers ?? new ValueCollection();

$content = $fields->get('content');

?>

<section class="generic-content band band--100">
    <div class="container">

        <?php if($content->has()) : ?>

            <?= $content->escape('wysiwyg'); ?>

        <?php endif; ?>

    </div>
</section>