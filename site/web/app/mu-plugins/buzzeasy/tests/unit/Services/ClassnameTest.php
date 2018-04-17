<?php

namespace Tests\Unit\Services;

use Tests\Unit\TestCase;
use Buzzeasy\App\Services\Classname;

class ClassnameTest extends TestCase
{
    public function testItCanGetNameOfClass()
    {
        $expected = 'SayHello';
        $actual = Classname::name('GoodChildren\SayHello');

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetRootOfClassNamespace()
    {
        $expected = 'GoodChildren';
        $actual = Classname::root('GoodChildren\SayHello');

        $this->assertEquals($expected, $actual);
    }
}
