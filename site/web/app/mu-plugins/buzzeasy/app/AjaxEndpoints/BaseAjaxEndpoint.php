<?php

namespace Buzzeasy\App\AjaxEndpoints;

use Exception;
use InvalidArgumentException;
use UnexpectedValueException;

use Buzzeasy\App\Traits\Requestable;
use Buzzeasy\App\Interfaces\AjaxEndpointable;
use Buzzeasy\App\Exceptions\AjaxValidationException;

/**
 * Provides basic actions needed by an AjaxEndpoint class
 */
abstract class BaseAjaxEndpoint implements AjaxEndpointable
{
    use Requestable;

    /**
     * @var array
     */
    public $allowed  = [];

    /**
     * @var array
     */
    public $default_allowed = ['ajax_nonce'];

    /**
     * @var string
     */
    public $nonce_action = 'mrb_ajax_nonce';

    /**
     * Tells the response to fire for unauthenticated users
     *
     * @var boolean
     */
    public $authenticated = true;

    /**
     * Tells the response to fire for unauthenticated users
     *
     * @var boolean
     */
    public $unauthenticated = true;

    /**
     * Overide to forcably disable nonce checking, exercise extreme caution when
     * disabling this...
     * @var boolean
     */
    public $validate_nonces = true;

    /**
     * Merges the default allowed fields with the child class's allowed fields
     *
     */
    public function __construct()
    {
        $this->allowed = array_unique(
            array_merge(
                $this->default_allowed,
                $this->allowed
            )
        );
    }

    /**
     * Grabs the response data from the parent class and respons to the request
     * with it. It does not error on no data as the response was successful, and
     * empty results is not an error state.
     *
     * @return void
     */
    public function respond()
    {
        try {
            $request = $this->request();
            $request->input()->whitelist($this->allowed);

            // Check for a valid nonce...
            if ($this->validate_nonces) {
                if (!$this->nonceIsValid($request->input()->get('ajax_nonce'))) {
                    $this->sendError('Invalid request');
                }
            }

            // Handle the request/response
            if (!$this->validateRequest($request)) {
                throw new AjaxValidationException(
                    'Request validation failed. Check the values sent in your request against approved types.'
                );
            }

            $response = $this->buildResponse($request);

            $this->sendSuccess($response);
        } catch (Exception $e) {
            $this->sendError($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Send an error response from the application
     *
     * @param  array $response
     * @return void
     */
    protected function sendSuccess(array $response)
    {
        wp_send_json_success($response);
    }

    /**
     * Send an error response from the application
     *
     * @param  string $error
     * @return void
     */
    protected function sendError(string $error, string $status_code = null)
    {
        $status_code = $status_code !== 0 ? $status_code : null;

        wp_send_json_error([
            'message' => $error,
        ], $status_code);
    }

    /**
     * Checks if nonce is valid
     *
     * @param  string $nonce
     * @return boolean
     */
    protected function nonceIsValid(string $nonce) : bool
    {
        return wp_verify_nonce($nonce, $this->nonce_action);
    }
}
