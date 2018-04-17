<?php

namespace Buzzeasy\App\Http;

use UnexpectedValueException;

class Input
{
    /**
     * @var array
     */
    private $data;

    /**
     * Set data on the class and create a default whitelist for all data so none
     * are restricted
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
        $this->whitelist = array_keys($data);
    }

    /**
     * Returns whitelisted data only
     *
     * @return array
     */
    public function all() : array
    {
        return array_intersect_key($this->data, array_flip($this->whitelist));
    }

    /**
     * Checks if requested key is whitelisted and throws exception if not.
     * Then returns requested data, or false if key does not exist.
     *
     * @param  string $key
     * @return any
     */
    public function get(string $key)
    {
        if (!in_array($key, $this->whitelist)) {
            throw new UnexpectedValueException('The parameter ' . $name . ' was not whitelisted for this request. Please ensure it is added to the $allowed array');
        }

        return $this->data[$key] ?? false;
    }

    /**
     * Overwrites the default whitelist.
     *
     * @param  array  $whitelist
     * @return Input
     */
    public function whitelist(array $whitelist)
    {
        $this->whitelist = $whitelist;

        return $this;
    }
}
