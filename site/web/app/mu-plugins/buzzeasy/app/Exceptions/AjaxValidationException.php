<?php

namespace Buzzeasy\App\Exceptions;

/**
 * Exception to denote an Ajax response which was made with invalid request
 * values. For example you may only want to restrict query params to known
 * values in a whitelist.
 */
class AjaxValidationException extends AjaxException
{
    //
}
