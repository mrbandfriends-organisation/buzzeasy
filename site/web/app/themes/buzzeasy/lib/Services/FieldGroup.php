<?php

namespace Roots\Sage\Services;

use Roots\Sage\Utils;
use Roots\Sage\Services\Field;

/**
 * Groups together a collection of fields from one source to allow easier
 * access to each as instances of the Roots\Sage\Services\Field class
 *
 * Eg:
 *    $fields = new FieldGroup([
 *        'header' => 'billboard_header',       // 'Lorem Ipsum'
 *    ]);
 *
 *    echo $fields->get('header');              // Lorem Ipsum
 */
class FieldGroup
{
    /**
     * @var array
     */
    private $fields = [];

    /**
     * @var array
     */
    private $values = [];

    /**
     * @param array  $fields
     * @param int|null $id
     */
    public function __construct(array $fields, int $id = null)
    {
        $this->fields = $fields;
        $this->id = $id;
    }

    /**
     * @param  string $field
     * @return object Field
     */
    public function get(string $field) : Field
    {
        if (isset($this->values[$field])) {
            return $this->values[$field];
        }

        if (!isset($this->fields[$field])) {
            $value = new Field;
        } else {
            $value = Field::get($this->fields[$field], $this->id);
        }

        $this->values[$field] = $value;

        return $this->values[$field];
    }
    /**
     * @param  string $field
     * @return bool
     */
    public function has(string $field) : bool
    {
        if (!isset($this->fields[$field])) {
            return false;
        }

        $this->values[$field] = $this->get($field);

        return (bool) $this->values[$field]->raw();
    }

    /**
     * @param  string $key
     * @return string
     */
    public function name(string $key)
    {
        return $this->fields[$key] ?? '';
    }
}
