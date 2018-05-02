<?php

namespace Buzzeasy\App\Utilities;

use ArrayAccess;
use Buzzeasy\App\Interfaces\Hasable;

/**
 * Wraps a given value to give access to helper methods like default() and
 * escape().
 *
 * When needing to use the Value $value in comparisons, e.g. to check
 * if he value is not falsey, the has() method should be used:
 *
 * Example:
 *     if ($value->has()) {
 *         echo $value->default('?');
 *      }
 *
 *
 * When needing to use the Value $value in manipulations you must use raw() to
 * return the raw value as its original datatype.
 *
 * Example:
 *     $newValue = $value->raw() + 100;
 *
 *
 * You can however echo Value without any chaining.
 * Example:
 *     echo Value::set($wpVariable);
 *
 */
class Value implements Hasable, ArrayAccess
{
    /**
     * The raw value passed into this class
     *
     * @var string
     */
    private $value = '';

    /**
     * Sets the passed in value as a class property. Defaults to '' so we can
     * have empty values
     *
     * @param any $value
     */
    public function __construct($value = '')
    {
        $this->value = $value;
    }

    /**
     * Returns the value as a string
     *
     * @return string
     */
    public function __toString() : string
    {
        return trim($this->value);
    }

    /**
     * Returns true if the raw value is truthy (e.g. not '', 0 false, null)
     * @return boolean
     */
    public function has() : bool
    {
        return (bool) $this->raw();
    }

    /**
     * Crates an instance of this class with a given value
     *
     * @param any $value
     * @return object Value
     */
    public static function set($value) : Value
    {
        return new static($value);
    }

    /**
     * Sets the value to the given default if the current value is falsey
     *
     * @param  array|int|string $default
     * @return object Value
     */
    public function default($default) : Value
    {
        if ($this->value === null || $this->value === '') {
            $this->value = $default;
        }

        return $this;
    }

    /**
     * Applies any number of functions to the value
     *
     * @param  callables $functions
     * @return Value
     */
    public function apply(...$functions) : Value
    {
        foreach ($functions as $function) {
            $this->value = call_user_func($function, $this->value);
        }

        return $this;
    }

    /**
     * Makes the field safe via existing functions in the desired circumstance
     *
     * @param  array $types
     * @return object Value
     */
    public function escape(string ...$types) : Value
    {
        foreach ($types as $type) {
            switch (strtolower($type)) {
                case 'attr':
                case 'attribute':
                    $this->value = \esc_attr($this->value);
                    break;

                case 'html':
                    $this->value = \esc_html($this->value);
                    break;

                case 'textarea':
                case 'wysiwyg':
                    $this->value = \wp_kses_post($this->value);
                    break;
            }
        }

        return $this;
    }

    /**
     * Returns the value in its raw type so that it can be maniplauted
     *
     * @return any
     */
    public function raw()
    {
        return $this->value;
    }





    /**
     * IMPLEMENTING: ArrayAccess
     *
     * These methods must be implemented for the ArrayAccess interface. They
     * allow the Value object to be used as an array (if the raw value is an
     * array)
     */

    /**
     * Allows checking of indexes for fields that return arrays (e.g. images)
     *
     * @param  string $key
     * @return boolean
     */
    public function offsetExists($key)
    {
        return isset($this->value[$key]);
    }

    /**
     * Allows retreieval of values for fields that return arrays (e.g. images)
     *
     * @param  string $key
     * @return boolean
     */
    public function offsetGet($key)
    {
        return $this->value[$key];
    }

    /**
     * Forbids setting values of fields that return arrays (e.g. images)
     *
     * @param  string $key
     * @return boolean
     */
    public function offsetSet($key, $value)
    {
        $this->value[$key] = $value;
    }

    /**
     * Forbids unsetting values of fields that return arrays (e.g. images)
     *
     * @param  string $key
     * @return boolean
     */
    public function offsetUnset($key)
    {
        $this->value[$key] = '';
    }
}
