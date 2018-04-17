<?php

namespace Buzzeasy;

use Buzzeasy\App\Services\Text;
use Buzzeasy\App\Services\Classname;
use Buzzeasy\App\Interfaces\Initialisable;

/**
 * PLUGIN CORE.
 *
 * Plugin base file. Controls initialisation of Plugin.
 */

class Core implements Initialisable
{
    /**
     * @var array
     */
    private $modules = [];

    /**
     * @var string
     */
    public static $plugin_slug;

    /**
     * @return void
     */
    public static function initialise()
    {
        $self = new self();

        $self->modules = require(__DIR__ . '/modules.php');

        $self->start();
    }

    /**
     * @return void
     */
    private function start()
    {
        self::getSlug();

        $this->registerModules();
    }

    /**
     * @return void
     */
    private function registerModules()
    {
        foreach ($this->modules as $key => $value) {
            if (is_array($value)) {
                new $key(...$value);
            } else {
                new $value;
            }
        }
    }

    /**
     * @return void
     */
    public static function activate()
    {
        flush_rewrite_rules();
    }

    /**
     * @return void
     */
    public static function deactivate()
    {
        flush_rewrite_rules();
    }

    /**
     * @return void
     */
    public static function getSlug()
    {
        if (!self::$plugin_slug) {
            self::$plugin_slug = Text::slugify(
                Classname::root(__CLASS__)
            );
        }

        return self::$plugin_slug;
    }
}
