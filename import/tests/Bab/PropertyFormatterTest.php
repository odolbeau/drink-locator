<?php

namespace Bab;

use Prophecy\Argument;
use Bab\PropertyFormatter;

class PropertyFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_is_initializable()
    {
        $propertyFormatter = new PropertyFormatter();

        $this->assertInstanceOf('Bab\PropertyFormatter', $propertyFormatter);
    }

    public function testFormat()
    {
        $properties = [
            'key' => 'value',
            'composed:key1' => 'value1',
            'composed:key2' => 'value2',
        ];

        $expectedProperties = [
            'key' => 'value',
            'composed' => [
                'key1' => 'value1',
                'key2' => 'value2',
            ]
        ];

        $propertyFormatter = new PropertyFormatter();
        $this->assertSame($expectedProperties, $propertyFormatter->format($properties));
    }
}
