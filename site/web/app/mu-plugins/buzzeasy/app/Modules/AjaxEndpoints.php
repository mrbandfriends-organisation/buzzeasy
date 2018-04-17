<?php

namespace Buzzeasy\App\Modules;

/**
 * Use in conjunction with the Buzzeasy\App\AjaxEndpoints classes in
 * Core::registerAdditionalModules().
 *
 * Example:
 *     new \Buzzeasy\App\Modules\AjaxEndpoints(
 *         \Buzzeasy\App\AjaxEndpoints\ExampleEndpoint::class
 *     );
 */
class AjaxEndpoints
{
    /**
     * Root of the hooks this request will be bound to.
     *
     * @var string
     */
    protected $hookRoot = 'wp_ajax';

    /**
     * Boots up the class
     *
     * @return void
     */
    public function __construct(...$classes)
    {
        foreach ($classes as $class) {
            $this->registerActions($class);
        }
    }

    /**
     * Builds the hook name based on the parent class and binds response. This
     * registers the endpoint with Wordpress
     *
     * @return void
     */
    private function registerActions(string $class)
    {
        $instance = new $class();

        if ($instance->authenticated) {
            add_action(
                sprintf('%s_%s', $this->hookRoot, $instance->action),
                [$instance, 'respond']
            );
        }

        if ($instance->unauthenticated) {
            add_action(
                sprintf('%s_nopriv_%s', $this->hookRoot, $instance->action),
                [$instance, 'respond']
            );
        }
    }
}
