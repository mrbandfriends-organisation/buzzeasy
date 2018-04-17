<?php

namespace Buzzeasy\App\Http;

class Request
{
    /**
     * @var Request
     */
    private static $instance;

    /**
     * @var Input
     */
    private $input;

    /**
     * @var string
     */
    private $method;

    /**
     * Restrict the user from creating new instances as we want to return the
     * same one with the same properties if called multiple times over one
     * request. This reduces object verhead and preserves the input whitelist.
     */
    private function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Sets the $instance property to an instance of request if it does not
     * already exist. Returns this instance.
     *
     * @return Request
     */
    public static function instance() : Request
    {
        if (!self::$instance) {
            self::$instance = new Request;
        }

        return self::$instance;
    }

    /**
     * Returns an Input object with the request data in
     *
     * @param  string|null $key
     * @return Input
     */
    public function input(string $key = null) : Input
    {
        if (!$this->input) {
            $this->input = new Input($this->retrieveBodyFromRequest());
        }

        return $this->input;
    }

    /**
     * Returns the HTTP method
     *
     * @return string
     */
    public function method()
    {
        return $this->method;
    }

    /**
     * Get body from request based on method
     *
     * @return array
     */
    private function retrieveBodyFromRequest()
    {
        switch ($this->method) {
            case 'POST':
                return $_POST;
            case 'GET':
                return $_GET;
            default:
                return [];
        }
    }
}
