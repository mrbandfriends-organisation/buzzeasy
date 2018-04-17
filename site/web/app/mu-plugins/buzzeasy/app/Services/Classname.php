<?php

namespace Buzzeasy\App\Services;

use Buzzeasy\App\Services\Text;

/**
 * This class is used to manipulate the fully qualified namespace of a class
 * (retrieved with static::class) - for example getting the class
 * name or the root namespace.
 *
 * Example:
 *     echo Classname::name(static::class); // ExampleWithConfig
 *     echo Classname::root(static::class); // Buzzeasy
 */
class Classname
{
    /**
     * Returns the short classname, i.e. the last segment of the fully
     * qualified namespace
     *
     * @param  string $string
     * @return string
     */
    public static function name(string $string) : string
    {
        $parts = explode('\\', $string);

        return array_pop($parts);
    }

    /**
     * Returns the root namespace, i.e. the first segment of the fully
     * qualified namespace
     *
     * @param  string $string
     * @return string
     */
    public static function root(string $string) : string
    {
        $parts = explode('\\', $string);

        return array_shift($parts);
    }
}
