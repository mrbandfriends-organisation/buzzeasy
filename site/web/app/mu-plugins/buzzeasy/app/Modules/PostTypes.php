<?php

namespace Buzzeasy\App\Modules;

use CPT;
use Buzzeasy\Core;
use Buzzeasy\App\Services\Text;
use Buzzeasy\App\Services\Classname;
use Buzzeasy\App\Services\PostToPostConnection;

/**
 * Use in conjunction with the Buzzeasy\App\PostTypes classes in
 * Core::registerAdditionalModules().
 *
 * Example:
 *     new \Buzzeasy\App\Modules\PostTypes(
 *         \Buzzeasy\App\PostTypes\Example::class
 *     );
 */
class PostTypes
{
    /**
     * Registers the post type. Also registers any taxonomies and any
     * connections which need to be set up, as defined on the parent class (see
     * README for more info)
     *
     * Do not set up a new post type for Posts and Pages as they already exist,
     * but do set up connections and taxonomies.
     *
     * @param string $domain
     */
    public function __construct(...$classes)
    {
        foreach ($classes as $class) {
            if (!in_array(Classname::name($class), ['post', 'page'])) {
                $this->registerPostType($class);
            }

            $this->registerTaxonomies($class);

            add_action('p2p_init', [$class, 'connect']);
        }
    }

    /**
     * Creates the new custom post type
     *
     * @return void
     */
    public function registerPostType(string $class)
    {
        $this->cpt = new CPT(
            $this->getTerms($class),
            $this->getConfig($class)
        );

        $this->cpt->menu_icon($class::$icon);
    }

    /**
     * Registers any taxonomies defined on the parent class
     *
     * @return void
     */
    public function registerTaxonomies(string $class)
    {
        if ($class::$taxonomies) {
            foreach ($class::$taxonomies as $key => $taxonomy) {
                if (is_array($taxonomy)) {
                    $data = array_merge($this->getTaxonomy($key), $taxonomy);
                } else {
                    $data = $this->getTaxonomy($taxonomy);
                }

                $this->cpt->register_taxonomy($data);
            }
        }
    }

    /**
     * Merges custom terms from the parent class into defaults
     *
     * @return array
     */
    public function getTerms(string $class) : array
    {
        $domain = Core::getSlug();
        $name = $this->getPostTypeName($class);

        return array_merge([
            'post_type_name'    => __($name, $domain),
            'singular'          => __(Text::toTitleCase($name, 'title'), $domain),
            'plural'            => __(Text::toTitleCase($name, 'title') . 's', $domain),
            'slug'              => __($name, $domain),
        ], $class::$terms);
    }

    /**
     * Merges custom config from the parent class into defaults
     *
     * @return array
     */
    public function getConfig(string $class) : array
    {
        return array_merge([
            'show_in_nav_menus' => true,
            'hierarchical'      => false,
            'supports'          => [
                'title',
                'thumbnail',
                'page-attributes',
            ],
            'has_archive'       => false,
        ], $class::$config);
    }

    /**
     * Creates a taxonomy config based on the taxonomy name
     *
     * @return array
     */
    public function getTaxonomy(string $taxonomy) : array
    {
        $domain = Core::getSlug();

        return [
            'taxonomy_name'    => __($taxonomy, $domain),
            'singular'          => __(Text::toTitleCase($taxonomy, 'title'), $domain),
            'plural'            => __(Text::toTitleCase($taxonomy, 'title') . 's', $domain),
            'slug'              => __($taxonomy, $domain),
        ];
    }

    /**
     * Checks if a post type name has been specifically set on the parent class.
     * If not, derive it from the parent class name.
     *
     * @return string
     */
    public function getPostTypeName(string $class) : string
    {
        if ($class::$name) {
            return $class::$name;
        }

        return Text::slugify(Classname::name($class));
    }
}
