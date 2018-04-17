<?php 
/**
 * INLINE VIDEO
 *
 * simple video player inline
 */
use Roots\Sage\Utils;

$type               = ( !empty($type) ) ? $type : '';
$video_id           = ( !empty($video_id) ) ? $video_id : '';
$sources            = ( !empty($sources) && is_array($sources) ) ? $sources : [];
$poster             = ( !empty($poster) ) ? $poster : '';
$hide_controls      = ( $hide_controls ) ? '' : ' controls';
?>

<div class="js-inline-video">    
    <?php if ( !empty($type) && ( $type === "youtube" || $type === "vimeo" ) ): ?>
        <div data-type="<?=esc_attr($type);?>" data-video-id="<?=esc_attr($video_id);?>"></div>    
    <?php else: ?>
        <?php if (!empty($sources) && is_array( $sources ) ): ?>

        <video poster="<?=esc_attr($poster);?>"<?=esc_attr($hide_controls);?>>
        <?php foreach ($sources as $source): ?>   
            <?php if ( !Utils\aempty( $source['src'], $source['type'] ) ): ?>                       
            <source src="<?=esc_attr($source['src']);?>" type="video/<?=esc_attr($source['type']);?>">
            <?php endif ?>      
        <?php endforeach; ?>       
        </video>  

        <?php endif ?>    
    <?php endif ?>    
</div>
