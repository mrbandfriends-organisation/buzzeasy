<?php

namespace Buzzeasy\App\Modules;

/**
 * Use in conjunction with the Buzzeasy\App\AdminFilters classes in
 * Core::registerAdditionalModules():
 *
 * Example:
 *     new \Buzzeasy\App\Modules\AdminFilters(
 *         \Buzzeasy\App\AdminFilters\ExampleRatingFilter::class
 *     );
 */
class AdminFilters
{
    /**
     * Boots up the class
     *
     * @return void
     */
    public function __construct(...$classes)
    {
        foreach ($classes as $class) {
            $this->registerActions($class);
            $this->registerFilters($class);
        }
    }

    /**
     * Registers the action that adds the input HTML to the admin page for this
     * CPT
     *
     * @return void
     */
    private function registerActions(string $class)
    {
        if (!empty($_GET['post_type']) && $_GET['post_type'] == $class::$postType) {
            add_action('restrict_manage_posts', [$class, 'getInputHtml']);
        }
    }

    /**
     * Registers the filter which applies the new filter to the filter query
     * after submit. Only triggers if we're on the edit.php page (admin page
     * for this CPT), if the filter has data and the post type is correct
     *
     * @return void
     */
    private function registerFilters(string $class)
    {
        global $pagenow;

        if (!empty($_GET['post_type'])
            && $pagenow == 'edit.php'
            && $_GET['post_type'] == $class::$postType
        ) {
            add_filter('parse_query', [$class, 'parseQuery']);
        }
    }
}
