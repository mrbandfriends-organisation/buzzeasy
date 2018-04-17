<?php

namespace Roots\Sage\Services;

require __DIR__ . '/Post.php';

use Exception;
use Roots\Sage\Utils;

/**
 * Provides easy access to properties of a page by providing it with the page ID or title
 *
 * Eg:
 *     $page = new Page(2);
 *     echo $page->id;                              // 2
 *     echo $page->title;                           // About Us
 *     foreach ($page->children as $child) {
 *         echo $child->title;                      // About Us - History
 *     }
 */
class Page extends Post
{
    /**
     * @var array
     */
    protected $children;

    /**
     * @param int|string $identifier - id or title of the page to get properties for
     */
    public function __construct($identifier)
    {
        if (is_string($identifier)) {
            $identifier = $this->getPageIdByTitle($identifier);
        }

        $this->id = $identifier;
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
        ]);

        return array_map(function ($page) {
            return new Page($page->ID);
        }, $pages);
    }

    /**
     * Gets the page ID fromt he title
     *
     * @param  string $title
     * @return void
     */
    protected function getPageIdByTitle(string $title) : int
    {
        return get_page_by_title($title)->ID;
    }
}
