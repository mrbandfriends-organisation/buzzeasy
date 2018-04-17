<?php

namespace Roots\Sage\Assets;
use Roots\Sage\Utils;

/**
 * Get paths for assets
 */
class JsonManifest {
  private $manifest;

  public function __construct($manifest_path) {
    if (file_exists($manifest_path)) {
      $this->manifest = json_decode(file_get_contents($manifest_path), true);
    } else {
      $this->manifest = [];
    }
  }

  public function get() {
    return $this->manifest;
  }

  public function getPath($key = '', $default = null) {
    $collection = $this->manifest;
    if (is_null($key)) {
      return $collection;
    }
    if (isset($collection[$key])) {
      return $collection[$key];
    }
    foreach (explode('.', $key) as $segment) {
      if (!isset($collection[$segment])) {
        return $default;
      } else {
        $collection = $collection[$segment];
      }
    }
    return $collection;
  }
}

function asset_path($filename, $type=null) {

    $file = basename($filename);

    if (WP_ENV === "development") {
        switch ($type)
        {
            case 'javascript':
                $type_dir = 'js/dist/';
                break;
            case 'css':
                $type_dir = 'css/';
                break;
        }
        return get_template_directory_uri() . '/assets/' . $type_dir . $file;
    }

    // ENVS with "built" assets
    $directory = dirname($filename) . '/';

    $dist_path = get_template_directory_uri() . '/assets/build/';
    static $manifest;

    if (empty($manifest)) {
        $manifest_path = get_template_directory() . '/assets/build/manifest.json';
        $manifest = new JsonManifest($manifest_path);
    }

    if (array_key_exists($file, $manifest->get())) {
        $rtn = $dist_path . $manifest->get()[$file];
    }

    return $rtn;
}





/**
 * GET RESPONSIVE IMAGE
 *
 * Creats a responsive image. Can be returns as an array of iameg attrs or
 * as a responsive `<img>`.
 *
 * @param   image_id    the ID of the attachment to generate markup for
 * @param   config      a hash of options
 * @param   output_tag  Boolean if you want to output array of image attrs or an <img>
 */
function get_responsive_image( $image_ref, $config = [], $output_tag = true )
{
    // 0. sanity check our input to make sure we’re not being passed null/a non-attachment
    if ( empty($image_ref) )
    {
        throw new \InvalidArgumentException('No image reference provided', 1);
    }

    if (!function_exists('wp_intervention'))
    {
        throw new \InvalidArgumentException('WP Intervention must be installed and active', 1);
    }

    // 1. get some defaults
    $config = wp_parse_args($config, [
        'dimensions'   => [ 1200, 768, 600, 320 ],
        'default_dim'  => 600,
        'aspect_ratio' => null,
        'class'        => 'attachment-thumbnail',
        'intervention' => [],
        'alt'          => '' // empty string is the minimumal requirement for alt
    ]);



    // 2. Grab basic HTML attributes
    // Remove non-html attributes from the
    $allowed_html_attrs = ['class', 'alt', 'width', 'height', 'style'];
    $html_attributes = array_filter(
        $config,
        function ($key) use ($allowed_html_attrs) {
            return in_array($key, $allowed_html_attrs);
        },
        ARRAY_FILTER_USE_KEY
    );

    // Handle attachments
    if ( absint( $image_ref ) || ( get_post_type( $image_ref ) === 'attachment' ) )
    {
        // If we have an attachment ID as the ref then get the server path
        // this is more reliable than urls as Intervention will balk at
        // self-signed SSL certs over https
        $image_ref = get_attached_file($image_ref);

        // If we have't provided an alt then attempt to retrieve it
        if (empty( $config['alt'] ) )
        {
            $html_attributes['alt'] = ( !empty(Utils\get_image_alt_by_id( $image_ref )) ? Utils\get_image_alt_by_id( $image_ref ) : " " );
        }
    }

    // Process the default image "src"
    $html_attributes['src'] = generate_image($image_ref, $config['default_dim'], $config['aspect_ratio'], $config['intervention']);

    // Process the other sizes to generate a "srcset"
    $aSrcset = array_map(function($size) use ($image_ref, $config)
    {
        return generate_image($image_ref, $size, $config['aspect_ratio'], $config['intervention'])." {$size}w";
    }, $config['dimensions']);

    // filter any points where we’ve returned false from generate_image
    $aSrcset = array_filter($aSrcset, function($sSource) { return ($sSource !== false); });

    // Generate the "srcset" attribute string
    if (count($aSrcset) > 0)
    {
        $html_attributes['srcset'] = join(', ', $aSrcset);
    }
    unset($aSrcset);

    // 4.5 - ensure we have a sizes attribute if the user didn't provide
    if ( empty( $config['sizes'] ) && !empty($config['dimensions']))
    {
        $largest_image = max( $config['dimensions'] );
        $html_attributes['sizes'] = "(max-width: {$largest_image}px) 100vw, {$largest_image}px";
    }

    // double-check things
    if (($html_attributes['src'] === false) && !isset($html_attributes['srcset']))
    {
        return '';
    }

    // 5. output
    if ($output_tag) {
        return  Utils\tag('img', $html_attributes);
    } else {
     return $html_attributes;
    }
}





/**
 * GET RESPONSIVE IMAGE ATTRS
 *
 * Returns an array of `<img>` attributes.
 *
 * @param   image_id    the ID of the attachment to generate markup for
 * @param   config      a hash of options
 * @return  array       array of `<img>` attributes
 */
function get_responsive_image_attrs( $image_ref, $config = [] )
{
    return get_responsive_image($image_ref, $config, false);
}




/**
 *  LAZY LOADED IMAGE
 *
 *  Use get_responsive_image_attrs to build an array of `<img>` attributes.
 *  Then it passes this data to a template file to build a responsive img.
 *  The javascript for lazyloading images is lazysizes;
 *  https://github.com/aFarkas/lazysizes
 *
 * @param   image_id    the ID of the attachment to generate markup for
 * @param   config      a hash of options
 * @return  array       array of `<img>` attributes
*/
function lazyload_image($image_ref, $config = []) {

    // 1. Uses get_responsive_image_attrs to get responsive image attrs built
    $img_attrs = get_responsive_image_attrs($image_ref, $config);

    // 2. Checks if there is a src & srcset attr. Then send
    // the data off to our lazy-image partial.
    if (!empty($img_attrs['src']) && !empty($img_attrs['srcset'])) {
        return Utils\ob_load_template_part('templates/partials/shared/lazy-image', $img_attrs);
    }
}





/**
 * GET RESPONSIVE IMAGE SRCSET
 *
 * Returns a string `<img>` srcset values. This is used for lazyloaded
 * responsive background images along side lazysizes extention plugin
 * bgset - https://github.com/aFarkas/lazysizes/tree/gh-pages/plugins/bgset
 *
 * @param   image_id    the ID of the attachment to generate markup for
 * @param   config      a hash of options
 * @return  string      string of `<img>` srcset values
 */
function get_responsive_image_srcset($image_ref, $config = []) {
    // 1. Builds a responsive image
    $img_attrs = get_responsive_image_attrs($image_ref, $config);

    // 2. Checks if srcset is set
    $srcset = ( !empty($img_attrs['srcset']) ? $img_attrs['srcset'] : null );

    // 3. Returns srcset
    return $srcset;
}





/**
* LAZY LOADED BACKGROUND IMAGE FROM THEME
*
* This function gets an image from inside the themes img directory.
* It then returns it as the full path to the image. This function should
* be added into the `<img>` tag.
*
* @param   $image_name    {string}    Name of image file
*/
function lazyload_local_bgimg($image_name = null) {
    if( !empty($image_name) ) {
        return 'data-bgset="' . get_template_directory_uri() . '/assets/images/' . esc_attr($image_name) .'"';
    }
}





/**
 *  BG IMAGE DATA
 *
 *  Calling `get_responsive_image_srcset()` and generating background image data
 *
 *  @param   image_id    the ID of the attachment to generate markup for
 *  @param   config      a array of options
 */
function bg_image_data($bg_image_id = null, $args = ['dimensions' => [ 1600, 1300, 900, 658, 540, 320 ], 'aspect_ratio' => 16/9]) {
    if( !empty($bg_image_id) ) {
        $bg_image_data = get_responsive_image_srcset( $bg_image_id, $args);
    } else {
        $bg_image_data = null;
    }

    return $bg_image_data;
}




function generate_image($image, $width, $aspect_ratio=null, $intervention_args=[])
{
    $additional_args = [];

    // split based on whether we have an aspect ratio
    if (isset($aspect_ratio))
    {
        $additional_args['fit'] = [
            $width,
            round($width / $aspect_ratio),
            function($constraint)
            {
                $constraint->upsize();
            }
        ];
    }
    else
    {
        // no aspect ratio, so maintain the existing one
        $additional_args['resize'] = [
            $width,
            null,
            function($constraint)
            {
                $constraint->aspectRatio();
                $constraint->upsize();
            }
        ];
    }

    $intervention_args = wp_parse_args($intervention_args, $additional_args);

    try
    {
        $rtn = \wp_intervention( $image, $intervention_args);
    }
    catch (\Exception $oE)
    {
        $rtn = false;
    }


    return $rtn;
}




/**
 * Resonsive alternative to the_post_thumbnail.
 */
function the_responsive_thumbnail( $post_id = null, $aConf = [] )
{
    // 1. if there’s no postID, use the current one
    if ($post_id === null)
    {
        $post_id = get_the_ID();
    }

    // 2. check things
    if (!has_post_thumbnail($post_id))
    {
        return '';
    }

    // 3. get the thumbnail ID
    return get_responsive_image(get_post_thumbnail_id($post_id), $aConf);
}





/**
 * Adds the last modification date of a file to the URL.
 */
function bust_caching($sUri)
{
    // 0. Don't filter any scripts for the admin
    if (is_admin())
    {
        return $sUri;
    }

    // 1. strip domain off the front of the source
    $sUri = preg_replace_callback('/https?:\/\/(.*?)\//', function($aM)
    {
        return ($aM[1] === 'fonts.googleapis.com') ? $aM[0] : '/';
    }, $sUri);

    // 2. strip query string
    $sUri  = preg_replace('/ver=([0-9\.]+)&?/', '', $sUri);
    $exploded = explode('?', $sUri);
    if (isset( $exploded[1]))
    {
        list($sUri, $sQs) = $exploded;
        $sQs = "?{$sQs}";
    }
    else
    {
        list($sUri) = $exploded;
        $sQs = '';
    }

    // 2. work out the local path to the file, and get a timestamp for it
    $sPath  = dirname(ABSPATH).preg_replace('/\?(.*?)$/', '', $sUri);
    $sStamp = file_exists($sPath) ? '.'.filemtime($sPath) : '';

    // 3. now work out the basename + extension
    if (preg_match('/^(.*)\.(\w+)$/', $sPath, $aM))
    {
        $sBasename = $aM[1];
        $sExt = ".{$aM[2]}";
    }
    else
    {
        return $sUri;
    }

    // 4. are we minifying
    $sMin = '';
    if (defined('WP_ENV') && (WP_ENV !== 'development') && file_exists("{$sBasename}.min{$sExt}"))
    {
        $sMin = ".min";
    }

    // 5. finally!
    return preg_replace('/\.(\w+)$/', $sMin.$sStamp.$sExt, $sUri).$sQs;
}
//add_filter('script_loader_src', __NAMESPACE__.'\\bust_caching');
//add_filter('style_loader_src', __NAMESPACE__.'\\bust_caching');
