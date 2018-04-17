<?php

namespace Buzzeasy\App\PostTypes;

use WP_Query;
use Buzzeasy\App\Services\Text;
use Buzzeasy\App\Services\Classname;
use Buzzeasy\App\Services\PostTypeQuerier;
use Buzzeasy\App\Services\PostToPostConnection;

/**
 * All PostType classes should extend this abstract class. The post type class
 * can be used to query the database by using methods from
 * PostTypeQuerier.php, either staically or dynamically:
 *
 * Setup Example:
 *     new ClassWhichExtendsBasePostType()
 *
 * Query Example:
 *     ClassWhichExtendsBasePostType::where($wheres)->limit(5)->get()
 *
 */
abstract class BasePostType
{
    /**
     * @var string
     */
    public static $name;

    /**
     * @var string
     */
    public static $icon = 'dashicons-format-aside';

    /**
     * @var array
     */
    public static $config = [
        'supports'  => ['title', 'page-attributes'],
    ];

    /**
     * @var array
     */
    public static $terms = [];

    /**
     * @var array
     */
    public static $taxonomies = [];

    /**
     * @var array
     */
    public static $connections = [];

    /**
     * @var PostTypeQuerier
     */
    public static $querier = [];

    /**
     * Passes dynamic calls to query methods onto the PostTypeQuerier
     *
     * @param  string $function
     * @param  array  $arguments
     * @return any
     */
    public function __call(string $function, array $arguments)
    {
        $this::$querier  = new PostTypeQuerier(
            new WP_Query,
            $this->getPostTypeName(static::class)
        );

        return $this::$querier->$function(...$arguments);
    }

    /**
     * Passes static calls to query methods onto the PostTypeQuerier
     *
     * @param  string $function
     * @param  array  $arguments
     * @return any
     */
    public static function __callStatic(string $function, array $arguments)
    {
        $self = new static();

        $self::$querier  = new PostTypeQuerier(
            new WP_Query,
            $self::getPostTypeName(static::class)
        );

        return $self::$querier->$function(...$arguments);
    }

    /**
     * Registers any post-to-post connections as defined on the parent class
     *
     * @return void
     */
    public static function connect()
    {
        if (static::$connections) {
            $from = static::getPostTypeName(static::class);

            foreach (static::$connections as $key => $connection) {
                $config = [];

                if (is_array($connection)) {
                    $config = $connection;
                    $connection = $key;
                }

                $to = static::getPostTypeName($connection);

                new PostToPostConnection($from, $to, $config);
            }
        }
    }

    public static function getPostTypeName(string $class)
    {
        return $class::$terms['post_type_name'] ?? Text::slugify(
            Classname::name($class)
        );
    }
}
