<?php

namespace Buzzeasy\App\PostTypes;

/**
 * This class extends the BasePostType abstract class, which sets up all the
 * stuff it needs. It is used to set up the custom post type in Core.php by
 * newing it up, or, and it can be used to query the database by using methods
 * from PostTypeQuerier.php, either staically or dynamically:
 *
 * Setup Example:
 *     new Example()
 *
 * Query Example:
 *     Example::where($args)->limit(5)->get()
 *
 */
class Example extends BasePostType
{
    /**
     * Overwrites the default post type name, which is derived from the class
     * name
     *
     * @var string
     */
    // public static $name = 'configured-example';

    /**
     * @var string
     */
    // public static $icon = 'dashicons-menu';

    /**
     * Overrides the default post type config settings
     * @var array
     */
    // public static $config = [
    //     'show_in_nav_menus' => false,
    //     'hierarchical'      => true,
    //     'supports'          => ['title'],
    //     'has_archive'       => true,
    // ];

    /**
     * Overrides the defaults for post type terminology
     *
     * @var array
     */
    // public static $terms = [
    //     'post_type_name'    => 'configured-example',
    //     'singular'          => 'Configured Example',
    //     'plural'            => 'Many Configured Examples',
    //     'slug'              => 'configured-example',
    // ];

    /**
     * Tells the base class which taxonomies to set up for this post type.
     * simply give a string to opt to use the default terminology that gets
     * generated, or give an array to override the defaults.
     *
     * @var array
     */
    // public static $taxonomies = [
    //     'category' => [
    //         'plural' => 'categories',
    //     ],
    //     'year',
    // ];

    /**
     * Tells the base class which post types to set up connections to. Pass in
     * a string of the class name to use default configuration, or use the class
     * name as a key to pass configuration in as the array value.
     *
     * @var array
     */
    // public static $connections = [
    //     \Buzzeasy\App\PostTypes\Example::class,
    // ];
}
