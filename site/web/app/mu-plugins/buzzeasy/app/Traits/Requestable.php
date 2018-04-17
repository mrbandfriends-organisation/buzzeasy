<?php

namespace Buzzeasy\App\Traits;

use Buzzeasy\App\Http\Request;

trait Requestable
{
    /**
     * Returns an instance of Buzzeasy\App\Http\Request
     *
     * @return Request
     */
    public function request(): Request
    {
        return Request::instance();
    }
}
