<?php

namespace Buzzeasy\App\Services;

use WP_Query;
use Countable;
use ArrayIterator;
use IteratorAggregate;
use Buzzeasy\App\Services\Text;
use Buzzeasy\App\Utilities\Post;
use Buzzeasy\App\Interfaces\Hasable;

/**
 * This class is used to hold rows from the Post table
 */
class PostCollection implements Hasable, IteratorAggregate, Countable
{
    /**
     * The total number of pages available
     *
     * @var int
     */
    public $pages;

    /**
     * @var array
     */
    private $posts;

    /**
     * @var WP_Query
     */
    private $query;

    /**
     * @param WP_Query $query
     */
    public function __construct(WP_Query $query)
    {
        $this->query = $query;
        $this->pages = $query->max_num_pages;

        $this->posts = array_map(function ($post) {
            if (!class_exists($postClass = $this->getCustomClass($post->post_type))) {
                $postClass = '\Buzzeasy\App\Utilities\Post';
            }

            return new $postClass($post->ID);
        }, $query->posts);
    }

    /**
     * @param  string $name
     * @return any
     */
    public function __get(string $name)
    {
        return $this->query->$name;
    }

    /**
     * Returns false if there are no posts
     *
     * @return boolean
     */
    public function has() : bool
    {
        return !empty($this->posts);
    }

    /**
     * Returns the first post
     *
     * @return null|Post
     */
    public function first()
    {
        return $this->posts[0] ?? null;
    }

    /**
     * Returns posts as array
     *
     * @return array
     */
    public function toArray() : array
    {
        return $this->posts;
    }

    /**
     * @param  string $postType
     * @return string
     */
    private function getCustomClass(string $postType) : string
    {
        $classname = str_replace(' ', '', Text::toTitleCase($postType)) . 'Post';

        return '\Buzzeasy\App\Utilities\\' . $classname;
    }





    /**
     * IMPLEMENTING: IteratorAggregate
     *
     * This method must be implemented for the IteratorAggregate interface. It
     * allows the $values property to be iterated over as if it were an array
     */

    /**
     * @return ArrayIterator
     */
    public function getIterator() : ArrayIterator
    {
        return new ArrayIterator($this->posts);
    }





    /**
     * IMPLEMENTING: Countable
     *
     * This method must be implemented for the Countable interface. It allows
     * count($this) to be used to return the number of posts
     */

    /**
     * @return int
     */
    public function count() : int
    {
        return count($this->posts);
    }
}
