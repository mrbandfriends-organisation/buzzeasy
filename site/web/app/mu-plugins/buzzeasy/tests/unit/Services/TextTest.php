<?php

namespace Tests\Unit\Services;

use Tests\Unit\TestCase;
use Buzzeasy\App\Services\Text;

class TextTest extends TestCase
{
    public function testItCanGetSlugifyString()
    {
        $expected = 'all-good-children-say-hello';
        $actual = Text::slugify('AllGood children_SAY-hello');

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetTitleCasedString()
    {
        $expected = 'All Good Children Say Hello';
        $actual = Text::toTitleCase('All Good children_SAY-hello');

        $this->assertEquals($expected, $actual);
    }
}
