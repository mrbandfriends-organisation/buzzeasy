<?php

namespace Buzzeasy\App\Utilities;

use Countable;
use ArrayIterator;
use IteratorAggregate;

use Roots\Sage\Utils;
use Buzzeasy\App\Interfaces\Hasable;

class ValueCollection implements Hasable, IteratorAggregate, Countable
{
    /**
     * An array of Buzzeasy\App\Utilities\Value instances
     *
     * @var array
     */
    private $values = [];

    /**
     * @param  string $field
     * @return object Field
     */
    public function __construct($data = [])
    {
        $values = [];

        if ($data) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $values[$key] = new ValueCollection($value);
                } else if (!$value instanceof ValueCollection) {
                    if (!$value instanceof Value) {
                        $value = Value::set($value);
                    }

                    $values[$key] = $value;
                } else {
                    $values[$key] = $value;
                }
            }

            $this->values = $values;
        }
    }

    /**
     * @return bool
     */
    public function has() : bool
    {
        $values = array_filter($this->values, function ($item) {
            return $item->has();
        });

        return !empty($values);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->values);
    }

    /**
     * Removes the first item from the values array (using array_unshift, which
     * will get the first item regardless of key). Adds it back to the beginning
     * of the array again and returns the first item.
     *
     * @return object Field
     */
    public function first()
    {
        $first = array_shift($this->values);

        if ($first) {
            array_unshift($this->values, $first);

            return $first;
        }

        return new Value;
    }

    /**
     * @param  string $field
     * @return object Field
     */
    public function get(string $field)
    {
        return $this->values[$field] ?? new Value;
    }

    /**
     * Returns the value in its raw type
     * @return any
     */
    public function raw()
    {
        return $this->values;
    }

    /**
     * Allows items to be added to the value collection.
     *
     * @return valueCollection
     */
    public function add(string $key, $value)
    {
        if (is_array($value)) {
            $value = new self($value);
        } elseif (!is_object($value)) {
            $value = new Value($value);
        }

        $this->values[$key] = $value;

        return $this;
    }

    /**
     * @param string $index
     *
     * @return object Field
     */
    public function nth(string $index)
    {
        $counter = 1;

        foreach ($this->values as $value) {
            if ($counter == $index) {
                return $value;
            }

            ++$counter;
        }

        return new Value();
    }

    /**
     * IMPLEMENTING: IteratorAggregate
     *
     * This method must be implemented for the IteratorAggregate interface. It
     * allows the $values property to be iterated over as if it were an array
     */

    /**
     * @return ArrayIterator
     */
    public function getIterator() : ArrayIterator
    {
        return new ArrayIterator($this->values);
    }
}
