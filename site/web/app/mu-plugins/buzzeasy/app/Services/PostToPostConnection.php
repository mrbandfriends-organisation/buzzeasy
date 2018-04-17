<?php

namespace Buzzeasy\App\Services;

use Buzzeasy\App\Services\Classname;

/**
 * This class sets up post-to-post connections, as provided by the jjgrainger/
 * posts-to-posts composer package. It does everything it needs to simpy as a
 * result of being newed up.
 *
 * Example:
 *     new PostToPostConnection(
 *         ExampleWithConfig::class,
 *         ExampleWithoutConfig
 *     );
 */
class PostToPostConnection
{
    /**
     * Registers the connection between two post type classes
     *
     * @param string $from
     * @param string $to
     * @param array  $config
     */
    public function __construct(string $from, string $to, array $config = [])
    {
        \p2p_register_connection_type($this->getConfig($from, $to, $config));
    }

    /**
     * Generates the config needed by \p2p_register_connection_type to set up
     * the connection. It creates slugs from the post type classes it is
     * connecting
     *
     * @param  string $from
     * @param  string $to
     * @param  array  $config
     * @return array
     */
    public function getConfig(string $from, string $to, array $config = []) : array
    {
        return array_merge([
            'name'          => sprintf('%s_to_%s', $from, $to),
            'from'          => $from,
            'to'            => $to,
            'reciprocal'    => true,
            'sortable'      => 'to'
        ], $config);
    }
}
