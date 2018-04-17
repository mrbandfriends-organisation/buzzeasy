<?php

namespace Buzzeasy\App\AjaxEndpoints;

use Buzzeasy\App\Http\Request;
use Buzzeasy\App\Traits\Templatable;
use Buzzeasy\App\PostTypes\Example;
use Buzzeasy\App\Exceptions\AjaxEmptyQueryResultsException;

/**
 * Use in conjunction with the AjaxEndpoints module in
 * Core::registerAdditionalModules(). This creates an endpoint which will by
 * default be something like:
 *
 * /wp/wp-admin/admin-ajax.php?action=example_endpoint&ajax_nonce=4774fce639&
 * post_name=test
 *
 * Example:
 *     new \Buzzeasy\App\Modules\AjaxEndpoints(
 *         \Buzzeasy\App\AjaxEndpoints\ExampleEndpoint::class
 *     );
 *
 */
class ExampleEndpoint extends BaseAjaxEndpoint
{
    use Templatable;

    /**
     * The action for this ajax function, will be used to build the hook name
     *
     * @var string
     */
    public $action = 'example_endpoint';


    /**
     * $_POST/$_GET variables you are allowed to access
     *
     * @var array
     */
    public $allowed = ['post_name'];


    /**
     * Returns data to the BaseAjaxEndpoint to be encoded for JSON response
     *
     * @return array
     */
    public function buildResponse(Request $request) : array
    {
        // Pull data off the $_POST/$_GET['search_query']
        $post_name = $request->input()->get('post_name');

        $post = Example::where(['name' => $post_name])->first();

        if (!$post) {
            throw new AjaxEmptyQueryResultsException('No results found. Unable to build HTML response.');
        }

        // Build markup
        $html = $this->getTemplate('partials/shared/example.php', [
            'title' => $post->post_title,
            'description' => $post->post_content,
        ]);

        // Return response - must be an array
        return [
            'html' => $html,
            //'other_params' => $param
        ];
    }


     /**
     * You are strongly encouraged to flesh out this method
     * to actually validate the data types that are coming over to them in the
     * request. For example checking values against known expected values.
     * @return boolean whether the request is valid or not
     */
    public function validateRequest(Request $request) : bool
    {
        return is_string($request->input()->get('post_name'));
    }
}
