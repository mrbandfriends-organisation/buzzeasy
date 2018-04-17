<?php

namespace Tests\Unit\Modules;

use Tests\Unit\TestCase;
use Buzzeasy\App\Modules\CustomPostTypes;
use Buzzeasy\App\CustomPostTypes\Example;
use Buzzeasy\App\CustomPostTypes\ConfigExample;

class CustomPostTypesTest extends TestCase
{
    public function testItCanGetTermsWithoutOverwrites()
    {
        $module = new CustomPostTypes;

        $expected = [
            'post_type_name'    => 'example',
            'singular'          => 'Example',
            'plural'            => 'Examples',
            'slug'              => 'example',
        ];


        $actual = $module->getTerms(Example::class);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetTermsWithOverwrites()
    {
        $module = new CustomPostTypes;

        $expected = [
            'post_type_name'    => 'configured-example',
            'singular'          => 'Configured Example',
            'plural'            => 'Many Configured Examples',
            'slug'              => 'configured-example',
        ];

        $actual = $module->getTerms(ConfigExample::class);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetConfigWithoutOverwrites()
    {
        $module = new CustomPostTypes;

        $expected = [
            'show_in_nav_menus' => true,
            'hierarchical'      => false,
            'supports'          => [
                'title',
                'page-attributes',
            ],
            'has_archive'       => false,
        ];


        $actual = $module->getConfig(Example::class);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetConfigWithOverwrites()
    {
        $module = new CustomPostTypes;

        $expected = [
            'show_in_nav_menus' => false,
            'hierarchical'      => true,
            'supports'          => ['title'],
            'has_archive'       => true,
        ];

        $actual = $module->getConfig(ConfigExample::class);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetTaxonomyWithoutOverwrites()
    {
        $module = new CustomPostTypes;

        $expected = [
            'taxonomy_name'    => 'example',
            'singular'          => 'Example',
            'plural'            => 'Examples',
            'slug'              => 'example',
        ];

        $actual = $module->getTaxonomy('example');

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetNameWithoutOverwrites()
    {
        $module = new CustomPostTypes;

        $expected = 'example';

        $actual = $module->getPostTypeName(Example::class);

        $this->assertEquals($expected, $actual);
    }

    public function testItCanGetNameWithOverwrites()
    {
        $module = new CustomPostTypes;

        $expected = 'configured-example';

        $actual = $module->getPostTypeName(ConfigExample::class);

        $this->assertEquals($expected, $actual);
    }
}
