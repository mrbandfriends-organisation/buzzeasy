<?php

namespace Buzzeasy\App\Interfaces;

use Buzzeasy\App\Http\Request;

/**
 * Provides a contract that forces implementing classes to have the initialise()
 * method
 *
 */
interface AjaxEndpointable
{
    /**
     * This should be overwritten in the parent class, and should respond with
     * the required data
     *
     * @return void
     */
    public function buildResponse(Request $request) : array;

    public function validateRequest(Request $request) : bool;
}
