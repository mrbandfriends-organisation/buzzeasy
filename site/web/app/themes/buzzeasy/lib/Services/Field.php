<?php

namespace Roots\Sage\Services;

use Roots\Sage\Utils;

/**
 * Provides easy access to fields, allowing you to set default values and escaping values
 *
 * Eg:
 *     echo Field::get('header');                           // Lorem Ipsum
 *     echo Field::get('doesnt_exist')->default('Hello');   // Hello
 *     echo Field::get('copy')->escape('html');             // '<b>Blah</b> blah blah'
 */
class Field
{
    /**
     * @var array|int|string
     */
    private $value = '';

    /**
     * @var array
     */
    private $defaultAllowedTags = [
        'a'       => ['href' => [], 'title' => []],
        'br'      => [],
        'em'      => [],
        'strong'  => [],
        'p'       => [],
        'ul'      => [],
        'ol'      => [],
        'li'      => [],
    ];

    /**
     * Returns the value as a string
     * @return string
     */
    public function __toString() : string
    {
        return trim($this->value);
    }

    /**
     * @param  string $field
     * @param  int|null $id
     * @return object Field
     */
    public static function get(string $field, int $id = null) : Field
    {
        $class = new static;

        $class->value = get_field($field, $id) ?: '';

        return $class;
    }

    /**
     * @param  array|int|string $default
     * @return object Field
     */
    public function default($default) : Field
    {
        if (!$this->value) {
            $this->value = $default;
        }

        return $this;
    }

    /**
     * Makes the field safe via in the desired circumstance
     * @param  array $types
     * @return object Field
     */
    public function escape(string ...$types) : Field
    {
        foreach ($types as $type) {
            switch (strtolower($type)) {
                case 'attr':
                case 'attribute':
                    $this->value = esc_attr($this->value);
                    break;

                case 'html':
                    $this->value = esc_html($this->value);
                    break;

                case 'textarea':
                    $this->value = \wp_kses($this->value, $this->defaultAllowedTags);
                    break;

                case 'wysiwyg':
                    $this->value = \wp_kses($this->value, array_merge(
                        $this->defaultAllowedTags,
                        [
                            'h1'            => [],
                            'h2'            => [],
                            'h3'            => [],
                            'h4'            => [],
                            'h5'            => [],
                            'blockquote'    => [],
                            'img'           => ['src' => [], 'alt' => []],
                        ]
                    ));
                    break;
            }
        }

        return $this;
    }

    /**
     * Returns the value in its raw type
     * @return any
     */
    public function raw()
    {
        return $this->value;
    }
}
