<?php

namespace Tests\Unit\Services;

use WP_Query;
use Tests\Unit\TestCase;
use Buzzeasy\App\Services\PostTypeQuerier;

class PostTypeQuerierTest extends TestCase
{
    public function testItCanQueryWithWhere()
    {
        $wpQuery = $this->mock(WP_Query::class);

        $wpQuery->query([
            'post_status'               => 'publish',
            'posts_per_page'            => -1,
            'orderby' => [
                'menu_order'            => 'ASC',
            ],
            'no_found_rows'             => true,
            'update_post_term_cache'    => false,
            'post_type'                 => 'post',
            'title'                     => 'Hello World',
        ])
        ->shouldBeCalled();

        $querier = new PostTypeQuerier($wpQuery->reveal(), 'post');
        $querier->where(['title' => 'Hello World'])->get();

        $this->assertMethodsCalled();
    }

    public function testItCanQueryWithWhereTaxonomy()
    {
        $wpQuery = $this->mock(WP_Query::class);

        $wpQuery->query([
            'post_status'               => 'publish',
            'posts_per_page'            => -1,
            'orderby' => [
                'menu_order'            => 'ASC',
            ],
            'no_found_rows'             => true,
            'update_post_term_cache'    => false,
            'post_type'                 => 'post',
            'tax_query' => [
                [
                    'taxonomy' => 'news',
                    'field' => 'slug',
                    'terms' => 'war',
                ],
                [
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => 'depressing',
                ],
                'relation' => 'AND',
            ],
        ])
        ->shouldBeCalled();

        $querier = new PostTypeQuerier($wpQuery->reveal(), 'post');
        $querier->whereTaxonomy([
            'news' => 'war',
            'category' => 'depressing',
        ])->get();

        $this->assertMethodsCalled();
    }

    public function testItCanQueryConnected()
    {
        $wpQuery = $this->mock(WP_Query::class);

        $wpQuery->query([
            'post_status'               => 'publish',
            'posts_per_page'            => -1,
            'orderby' => [
                'menu_order'            => 'ASC',
            ],
            'no_found_rows'             => true,
            'update_post_term_cache'    => false,
            'post_type'                 => 'post',
            'connected_type' => 'post_to_category',
            'connected_items' => 5,
            'nopaging' => true,
        ])
        ->shouldBeCalled();

        $querier = new PostTypeQuerier($wpQuery->reveal(), 'post');
        $querier->connected(5, 'category')->get();

        $this->assertMethodsCalled();
    }

    public function testItCanLimitResults()
    {
        $wpQuery = $this->mock(WP_Query::class);

        $wpQuery->query([
            'post_status'               => 'publish',
            'posts_per_page'            => 5,
            'orderby' => [
                'menu_order'            => 'ASC',
            ],
            'no_found_rows'             => true,
            'update_post_term_cache'    => false,
            'post_type'                 => 'post',
        ])
        ->shouldBeCalled();

        $querier = new PostTypeQuerier($wpQuery->reveal(), 'post');
        $querier->limit(5)->get();

        $this->assertMethodsCalled();
    }

    public function testItCanOrderResults()
    {
        $wpQuery = $this->mock(WP_Query::class);

        $wpQuery->query([
            'post_status'               => 'publish',
            'posts_per_page'            => -1,
            'orderby' => [
                'title'            => 'DESC',
            ],
            'no_found_rows'             => true,
            'update_post_term_cache'    => false,
            'post_type'                 => 'post',
        ])
        ->shouldBeCalled();

        $querier = new PostTypeQuerier($wpQuery->reveal(), 'post');
        $querier->orderBy('title', 'DESC')->get();

        $this->assertMethodsCalled();
    }

    public function testItCanGetFirstOfResults()
    {
        $wpQuery = $this->mock(WP_Query::class);

        $wpQuery->query([
            'post_status'               => 'publish',
            'posts_per_page'            => 1,
            'orderby' => [
                'menu_order'            => 'ASC',
            ],
            'no_found_rows'             => true,
            'update_post_term_cache'    => false,
            'post_type'                 => 'post',
        ])
        ->shouldBeCalled();

        $querier = new PostTypeQuerier($wpQuery->reveal(), 'post');
        $querier->first();

        $this->assertMethodsCalled();
    }

    public function testItCanFindById()
    {
        $wpQuery = $this->mock(WP_Query::class);

        $wpQuery->query([
            'post_status'               => 'publish',
            'posts_per_page'            => 1,
            'orderby' => [
                'menu_order'            => 'ASC',
            ],
            'no_found_rows'             => true,
            'update_post_term_cache'    => false,
            'post_type'                 => 'post',
            'p'                         => 6,
        ])
        ->shouldBeCalled();

        $querier = new PostTypeQuerier($wpQuery->reveal(), 'post');
        $querier->find(6);

        $this->assertMethodsCalled();
    }

    public function testItCanGetAll()
    {
        $wpQuery = $this->mock(WP_Query::class);

        $wpQuery->query([
            'post_status'               => 'publish',
            'posts_per_page'            => -1,
            'orderby' => [
                'menu_order'            => 'ASC',
            ],
            'no_found_rows'             => true,
            'update_post_term_cache'    => false,
            'post_type'                 => 'post',
        ])
        ->shouldBeCalled();

        $querier = new PostTypeQuerier($wpQuery->reveal(), 'post');
        $querier->all();

        $this->assertMethodsCalled();
    }

    public function testItCanGetResults()
    {
        $wpQuery = $this->mock(WP_Query::class);

        $wpQuery->query([
            'post_status'               => 'publish',
            'posts_per_page'            => -1,
            'orderby' => [
                'menu_order'            => 'ASC',
            ],
            'no_found_rows'             => true,
            'update_post_term_cache'    => false,
            'post_type'                 => 'post',
        ])
        ->shouldBeCalled();

        $querier = new PostTypeQuerier($wpQuery->reveal(), 'post');
        $querier->get();

        $this->assertMethodsCalled();
    }
}
