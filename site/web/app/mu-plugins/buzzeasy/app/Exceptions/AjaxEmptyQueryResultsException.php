<?php

namespace Buzzeasy\App\Exceptions;

/**
 * Exception to denote an Ajax response which generated empty WP_Query results.
 */
class AjaxEmptyQueryResultsException extends AjaxException
{
    protected $code = 204;
}
