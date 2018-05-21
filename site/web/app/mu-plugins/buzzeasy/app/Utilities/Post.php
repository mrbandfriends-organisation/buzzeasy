<?php

namespace Buzzeasy\App\Utilities;

use WP_Post;
use Roots\Sage\Utils;
use Buzzeasy\App\Interfaces\Hasable;
use Buzzeasy\App\Services\PostCollection;
use Buzzeasy\App\Exceptions\PostNotFoundException;

class Post implements Hasable
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var WP_Post
     */
    protected $post;

    /**
     * @param int $id - id of the post to get properties for
     */
    public function __construct($id = null)
    {
        if (!$id) {
            $id = get_the_id();
        }

        $this->id = $id;
    }

    /**
     * Get post property or empty Value
     *
     * @param  string $name
     * @return array|int|string
     */
    public function __get(string $name)
    {
        $method = 'get' . ucfirst($name);

        if (!$this->post) {
            $this->post = get_post($this->id);

            if (!$this->post) {
                throw new PostNotFoundException("Your post could not be found");
            }
        }

        if ($name === 'id') {
            $this->$name = $this->getId();
        } else if (method_exists(static::class, $method)) {
            $this->$name = $this->convertRawValue($this->$method());
        } else {
            $this->$name = new Value;
        }

        return $this->$name;
    }

    /**
     * @return boolean
     */
    public function has() : bool
    {
        return (bool) $this->id;
    }

    /**
     * First check if it is a repeater field. If so return DataCollection. Then
     * if the field exists and it is a Post instance, convert it to out Post
     * object. If not, convert to Value.
     *
     * @param  string $name
     * @return array|int|string
     */
    public function field(string $name)
    {
        $value = \get_field($name, $this->id);

        if (is_array($value)) {
            $this->$name = new ValueCollection($value);
        } else if ($value !== null) {
            $this->$name = $this->convertRawValue($value);
        } else {
            $this->$name = new Value;
        }

        return $this->$name;
    }

    /**
     * Alias for fields that allows ValueCollections and PostCollections to be
     * used in the same partials interchangeably
     *
     * @param  string $name
     * @return any
     */
    public function get(string $name)
    {
        return $this->field($name);
    }


    /**
     * Gets the page id
     *
     * @return void
     */
    protected function getId() : int
    {
        return $this->id;
    }

    /**
     * @return void
     */
    protected function getType() : string
    {
        return $this->post->post_type;
    }

    /**
     * Gets the page title
     *
     * @return void
     */
    protected function getTitle() : string
    {
        return $this->post->post_title;
    }

    /**
     * Gets the page slug
     *
     * @return void
     */
    protected function getSlug() : string
    {
        return $this->post->post_name;
    }


    /**
     * Gets the page content
     *
     * @return void
     */
    protected function getContent() : string
    {
        return $this->post->post_content;
    }

    /**
     * Gets the page permalink
     *
     * @return void
     */
    protected function getLink() : string
    {
        return get_the_permalink($this->id);
    }

    /**
     * Gets the admin edit link
     *
     * @return void
     */
    protected function getEditLink() : string
    {
        return get_edit_post_link($this->id);
    }

    /**
     * Gets the page image
     *
     * @return void
     */
    protected function getImage($size = '') : array
    {
        return wp_get_attachment_image_src($this->imageId);
    }

    /**
     * Gets the page image
     *
     * @return void
     */
    protected function getImageId($size = '')
    {
        return get_post_thumbnail_id($this->id);
    }

    /**
     * Gets the page taxonomies
     *
     * @return void
     */
    public function getTaxonomies($type)
    {
        $taxonomies = wp_get_post_terms($this->id, [$type]);

        if (!is_array($taxonomies)) {
            return null;
        }

        return $taxonomies;
    }

    /**
     * Gets the child pages of this page
     *
     * @return void
     */
    protected function getChildren() : array
    {
        $pages = get_pages([
            'child_of' => $this->id,
            'parent' => $this->id,
            'sort_order' => 'asc',
            'sort_column' => 'menu_order',
        ]);

        return array_map(function ($page) {
            return new Post($page->ID);
        }, $pages);
    }

    private function convertRawValue($value)
    {
        if ($value instanceof WP_Post) {
            $value = Post($value->ID);
        } else if (is_array($value)) {
            $value = new ValueCollection($value);
        } else if (!is_subclass_of($value, Post::class)
            && !$value instanceof Post
            && !$value instanceof PostCollection
        ) {
            $value = Value::set($value);
        }

        return $value;
    }
}
