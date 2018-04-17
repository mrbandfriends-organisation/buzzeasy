<?php

namespace Buzzeasy\App\Utilities;

use StdClass;
use Countable;
use ArrayIterator;
use IteratorAggregate;

use Roots\Sage\Utils;
use Buzzeasy\App\Interfaces\Collectable;

class ValueCollection implements Collectable, IteratorAggregate, Countable
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
                if ($value instanceof StdClass) {
                    $value = json_decode(json_encode($value), true);
                }

                if (is_array($value)) {
                    $values[$key] = new ValueCollection($value);
                } elseif ($value instanceof WP_Post) {
                    $values[$key] = new Post($value->ID);
                } elseif (is_object($value)) {
                    $values[$key] = $value;
                } else {
                    $values[$key] = Value::set($value);
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
        return true;
    }

    /**
     * Allows items to be added to the value collection
     *
     * @param  string $key
     * @param  any $value
     * @return ValueCollection
     */
    public function add(string $key, $value)
    {
        if (is_array($value)) {
            $value = new ValueCollection($value);
        } else if (!is_object($value)) {
            $value = new Value($value);
        }

        $this->values[$key] = $value;

        return $this;
    }

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
     * @param  string $key
     * @return object Value
     */
    public function get($key)
    {
        return $this->values[$key] ?? new Value;
    }

    /**
     * Returns the value in its raw type
     * @return any
     */
    public function raw() : array
    {
        return array_map(function ($row) {
            if ($row instanceof Value || $row instanceof ValueCollection) {
                $row = $row->raw();
            }

            return $row;
        }, $this->values);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->values);
    }

    /**
     * Allows additional items to be added to the value collection.
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
