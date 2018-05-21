<?php

namespace Buzzeasy\App\Services;

use WP_Post;
use WP_Query;
use Buzzeasy\App\Utilities\Post;

class PostTypeQuerier
{
    /**
     * @var object WP_Query
     */
    private $query;

    /**
     * @var string
     */
    private $limit;

    /**
     * @var array
     */
    private $orderBy;

    /**
     * posts_per_page: -1 is no paging
     * no_found_rows: removes pagination if no rows
     *
     * @var array
     */
    private $params = [
        'post_status'               => 'publish',
        'posts_per_page'            => -1,
        'orderby' => [
            'menu_order'            => 'ASC',
        ],
        'no_found_rows'             => true,
        'update_post_term_cache'    => false,
    ];

    /**
     * @param WP_Query $query
     * @param string   $postType
     */
    public function __construct(WP_Query $query, string $postType = 'post')
    {
        $this->query = $query;

        $this->params['post_type'] = $postType;
    }

    /**
     * Adds WHERE filters to the existing query config. If the key passed in is
     * ID/id, convert to 'p' (wp primary key flag)
     *
     * @param  string $key
     * @param  any $value
     * @return PostTypeQuerier
     */
    public function where(string $key, $value) : PostTypeQuerier
    {
        if (strcasecmp($key, 'id') === 0) {
            $key = 'p';
        }

        $this->params[$key] = $value;

        return $this;
    }

    /**
     * Adds WHERE taxonomy filters to the existing query config
     *
     * @param  array $taxonomy          [$taxonomy => $terms]
     * @param  array  $terms
     * @return object PostTypeQuerier
     */
    public function whereMeta($key, $compare, $value = null) : PostTypeQuerier
    {
        if (!$value) {
            $value = $compare;
            $compare = '=';
        }

        if (!isset($this->params['meta_query'])) {
            $this->params['meta_query'] = ['relation' => 'AND'];
        }

        $this->params['meta_query'][] = [
            'key' => $key,
            'compare' => $compare,
            'value' => $value,
        ];

        return $this;
    }

    /**
     * Adds WHERE taxonomy filters to the existing query config
     *
     * @param  array $taxonomy          [$taxonomy => $terms]
     * @param  array  $terms
     * @return object PostTypeQuerier
     */
    public function whereTaxonomy(array $params, string $relation = 'AND') : PostTypeQuerier
    {
        $taxonomies = array_map(function (string $taxonomy, $terms) {
            return [
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => $terms,
            ];
        }, array_keys($params), $params);

        $taxonomies['relation'] = $relation;

        $this->params = array_merge(
            $this->params,
            [
                'tax_query' => $taxonomies,
            ]
        );

        return $this;
    }

    /**
     * Tells the querier to return posts connected to this one (of a given type)
     *
     * @param  int    $id
     * @param  string $postType
     * @return object PostTypeQuerier
     */
    public function connected(int $id, string $postType) : PostTypeQuerier
    {
        $types = [
            sprintf('%s_to_%s', $this->params['post_type'], $postType),
            sprintf('%s_to_%s', $postType, $this->params['post_type']),
        ];

        $this->params = array_merge(
            $this->params,
            [
                'connected_type' => $types,
                'connected_items' => $id,
                'nopaging' => true,
            ]
        );

        return $this;
    }

    /**
     * Adds a limit on the number of result returned
     *
     * @param  int    $limit
     * @return object PostTypeQuerier
     */
    public function limit(int $limit) : PostTypeQuerier
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Adds 'order by' sorting to the query results
     *
     * @param  string $column
     * @param  string $direction
     * @return object PostTypeQuerier
     */
    public function orderBy(string $column, string $direction = 'ASC') : PostTypeQuerier
    {
        $this->orderBy = [$column => $direction];

        return $this;
    }

    /**
     * Returns only the first result of the query
     *
     * @return Post
     */
    public function first()
    {
        $this->limit = 1;

        return $this->get()->first();
    }

    /**
     * Returns only the post of this type matching the ID given
     *
     * @param  int    $id
     * @return Post
     */
    public function find(int $id)
    {
        $this->limit        = 1;
        $this->params['p']  = $id;

        return $this->get()->first();
    }

    /**
     * Returns all results, without any filtering/ordering/limiting
     *
     * @return PostCollection
     */
    public function all() : PostCollection
    {
        return $this->get();
    }

    /**
     * Enables pagination and returns the desired number of results
     *
     * @param  int    $count
     * @return PostCollection
     */
    public function paginate(int $count) : PostCollection
    {
        $this->limit                    = $count;
        $this->params['no_found_rows']  = false;
        $this->params['nopaging']       = false;

        return $this->get();
    }

    /**
     * Returns all results for the existing query config
     *
     * @return PostCollection
     */
    public function get() : PostCollection
    {
        if ($this->limit) {
            $this->params['posts_per_page'] = $this->limit;
        }

        if ($this->orderBy) {
            $this->params['orderby'] = $this->orderBy;
        }

        return $this->fetch();
    }

    /**
     * Fetches the results for the existing query config
     *
     * @return PostCollection
     */
    private function fetch() : PostCollection
    {
        $this->query->query($this->params);

        return new PostCollection($this->query);
    }
}
