<?php 
/**
 * BACKGROUND VIDEO
 *
 * simple background video stuffs
 */
use Roots\Sage\Utils;

$type               = ( !empty($type) ) ? $type : '';
$video_id           = ( !empty($video_id) ) ? $video_id : '';
$sources            = ( !empty($sources) && is_array($sources) ) ? $sources : [];
$poster             = ( !empty($poster) ) ? $poster : '';
$show_controls      = ( $show_controls ) ? ' controls' : '';

$bgimg_src          = ( !empty($poster) ) ? 'background-image: url(' . $poster . ');' : '';

$data_sources = implode(' ', array_map(function($source) {
    $src    = $source['src'];
    $type   = $source['type'];
    return "data-bgvideo-source-$type='$src'";
}, $sources) );

?>
<div class="background-video js-background-video" <?=$data_sources;?>>    
    <?php if (!empty($poster)): ?>        
    <div class="background-video__poster" style="<?=esc_attr($bgimg_src);?>"></div>
    <?php endif ?>
      
    <video loop muted>          
    </video>   

    <div class="background-video__controls">
        <button title="Toggle video play state" class="background-video__control background-video__control--toggle play-pause js-video-player-toggle">Play</button>
    </div>
</div>
