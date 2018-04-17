<?php

namespace Tests\Unit\Services;

use Tests\Unit\TestCase;
use Buzzeasy\App\Services\PostToPostConnection;

class PostToPostConnectionTest extends TestCase
{
    public function testItCanGetConfig()
    {
        $data = ['you', 'me', ['sortable' => false]];

        $class = new PostToPostConnection(...$data);

        $expected = [
            'name'          => 'you_to_me',
            'from'          => 'you',
            'to'            => 'me',
            'reciprocal'    => true,
            'sortable'      => false,
        ];

        $actual = $class->getConfig(...$data);

        $this->assertEquals($expected, $actual);
    }
}
