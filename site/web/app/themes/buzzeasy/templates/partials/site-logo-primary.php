<?php
/**
* SITE LOGO
*
* uses RIMG (via Picturefill or Native) to load either SVG or PNG fallback
* of the logo...
*/

$modifier = ( !empty( $modifier ) ) ? $modifier : null;

?>
<a class="site-logo--primary <?= esc_attr($modifier); ?>" href="<?php echo esc_url( home_url('/') ); ?>">
	<picture>
		<!--[if IE 9]><video style="display: none;"><![endif]-->
		<source type="image/svg+xml" srcset="<?php echo esc_attr( get_stylesheet_directory_uri() . '/assets/svg/standalone/output/logo-primary.svg'); ?>">
		<!--[if IE 9]></video><![endif]-->
		<img src="<?php echo esc_attr(get_stylesheet_directory_uri() .'/assets/svg/standalone/output/png/logo-primary.png'); ?>" alt="<?php echo esc_attr(bloginfo('name'));?>">
	</picture>
</a>
