<?php

namespace Buzzeasy\App\Services;

/**
 * Provides methods for manipulating strings
 *
 * Example:
 *     echo Text::slugify('Hello World'); // hello-world
 *     echo Text::slugify('hello-world'); // Hello World
 */
class Text
{
    /**
     * Splits PascalCased strings into space separated strings, replaces
     * underscores with dashes and passes through WP's slugging function
     * (helpfully called 'sanitize_title_with_dashes')
     *
     * @param  string $string
     * @return string
     */
    public static function slugify(string $string) : string
    {
        $string = preg_replace(
            ['/(.*?[a-z]{1})([A-Z]{1}.*?)/', '/_/'],
            ['${1} ${2}', '-'],
            $string
        );

        return sanitize_title_with_dashes($string);
    }

    /**
     * Converts any type of string to Title Case (upper case first letters with
     * spaces)
     * @param  string $string
     * @return string
     */
    public static function toTitleCase(string $string) : string
    {
        return ucwords(str_replace('-', ' ', self::slugify($string)));
    }

    /**
     * Converts any type of string to snake_case
     * @param  string $string
     * @return string
     */
    private static function toSnakeCase(string $name) : string
    {
        return strtolower(preg_replace(
            '/(.*?[a-z]{1})([A-Z]{1}.*?)/',
            '${1}_${2}',
            $name
        ));
    }
}
