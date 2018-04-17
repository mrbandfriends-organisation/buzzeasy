<?php
    // CONTENT
    $src         = ( !empty($src) ? $src : null );
    $data_srcset = ( !empty($srcset) ? $srcset : null );
    $data_sizes  = ( !empty($sizes) ? $sizes : null );
    $alt         = ( !empty($alt) ? $alt : null );
    $class       = ( !empty($class) ? $class : null );
    $width       = ( !empty($width) ? 'width="'  . esc_attr($width) . '"' : null );
    $height      = ( !empty($height) ? 'height="'  . esc_attr($height) . '"' : null );
?>

<?php if( !empty($src) && !empty($data_srcset) ) : ?>
    <img
        class="<?= esc_attr($class);?> lazyload"
        data-src="<?= esc_attr( $src ); ?>"
        data-srcset="<?= esc_attr( $data_srcset ); ?>"
        data-sizes="<?= esc_attr( $data_sizes ); ?>"
        alt="<?= esc_attr( $alt ); ?>"
        <?= $width; ?>
        <?= $height; ?>
    />
    <noscript>
        <img class="<?= esc_attr($class);?>" src="<?= esc_attr( $src ); ?>" alt="<?= esc_attr( $alt ); ?>" <?= $width; ?> <?= $height; ?> />
    </noscript>
<?php endif; ?>
