<?php

namespace Buzzeasy\App\Modules;

/**
 * Use in conjunction with the Buzzeasy\App\AdminColumn classes in
 * Core::registerAdditionalModules():
 *
 * Example:
 *     new \Buzzeasy\App\Modules\AdminColumns(
 *         \Buzzeasy\App\AdminColumns\ExampleColumns::class
 *     );
 *
 */
class AdminColumns
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
     * Registers the filters which adds the column to the admin area for a specific CPT
     *
     * @return void
     */
    private function registerFilters(string $class)
    {
        if (!empty($class::$postType) && !empty($class::$columns)) {
            add_filter(
                sprintf('manage_%s_posts_columns', $class::$postType),
                function ($columns) use ($class) {
                    $columns = array_slice($columns, 0, 2, true)
                        + $class::$columns
                        + array_slice($columns, 2, null, true);

                    return $columns;
                }
            );
        }
    }

    /**
     * Registers the action that populates the column data
     * @return void
     */
    private function registerActions(string $class)
    {
        if (!empty($class::$postType) && !empty($class::$columns)) {
            add_action(
                sprintf('manage_%s_posts_custom_column', $class::$postType),
                function ($column) use ($class) {
                    global $post;

                    foreach ($class::$columns as $key => $value) {
                        if ($column == $key) {
                            $class::$key($post->ID);
                        }
                    }
                }
            );
        }
    }
}
