<?php

namespace Roots\Sage\Services;

use Exception;

/**
 * Provides easy access to properties of a post by providing it with the post ID
 *
 * Eg:
 *     $post = new Post(get_the_id());
 *     echo $post->id;                              // 2
 *     echo $post->title;                           // About Us
 *     echo $post->category;                        // News
 */
class Post
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $link;

    /**
     * @var string
     */
    protected $category;

    /**
     * @param int $id - id of the post to get properties for
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param  string $name
     * @return array|int|string
     */
    public function __get(string $name)
    {
        if (isset($this->$name)) {
            return $this->$name;
        }

        $method = 'get' . ucfirst($name);

        if (!method_exists($this, $method)) {
            throw new Exception("$name is not a valid property for Wordpress pages");
        }

        $this->$name = $this->$method();

        return $this->$name;
    }

    /**
     * Gets the page title
     *
     * @return void
     */
    protected function getId() : int
    {
        return $this->id;
    }
    /**
     * Gets the page title
     *
     * @return void
     */
    protected function getTitle() : string
    {
        return get_the_title($this->id);
    }

    /**
     * Gets the page permalink
     *
     * @return void
     */
    protected function getLink() : string
    {
        return get_page_link($this->id);
    }

    /**
     * Gets the page permalink
     *
     * @return void
     */
    protected function getCategory() : string
    {
        return Utils\get_primary_tax_term($this->id, 'category');
    }
}
