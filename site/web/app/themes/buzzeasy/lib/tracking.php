<?php

namespace Roots\Sage\Tracking;

use Roots\Sage\Utils;


/**
 * ADD GOOGLE TAG MANAGER CODE
 */
function google_tag_manager_code() {?>
  <?php if ( defined( 'GOOGLE_TAG_MANAGER_CODE' ) && !empty( GOOGLE_TAG_MANAGER_CODE )) { ?>
    <script type="text/javascript">
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
    	     'gaProfileId': '<?php echo GOOGLE_TAG_MANAGER_CODE ?>'
        });
    </script>
    <!-- Google Tag Manager -->
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KJP9LC"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KJP9LC');</script>
    <!-- End Google Tag Manager -->
  <?php } ?>
<?php
}
add_action('wp_footer', __NAMESPACE__ . '\\google_tag_manager_code', 21);


/**
 * ADD GOOGLE ANALYTICS CODE
 */
function google_analytics_code() {
    if ( defined( 'GOOGLE_ANALYTICS_CODE' ) && !empty( GOOGLE_ANALYTICS_CODE ) ): ?>
     <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', '<?php echo GOOGLE_ANALYTICS_CODE; ?>', 'auto');
        ga('send', 'pageview');

      </script>
    <?php endif; ?>
<?php
}
add_action('wp_footer', __NAMESPACE__ . '\\google_analytics_code', 19);
