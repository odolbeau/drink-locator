<?php

namespace OsrmClient\Iterator;

use Prophecy\Argument;
use OsrmClient\Iterator\Osm3xXmlIterator;
use OsrmClient\Element\Node;
use OsrmClient\Element\AttributeBag;
use OsrmClient\Element\TagBag;

class Osm3sXmlIteratorTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_is_initializable()
    {
        $iterator = new Osm3sXmlIterator(file_get_contents(__DIR__.'/../../fixtures/osrm_response_sample.xml'));

        $this->assertInstanceOf('OsrmClient\Iterator\Osm3sXmlIterator', $iterator);
    }

    public function test_iterator()
    {
        $iterator = new Osm3sXmlIterator(file_get_contents(__DIR__.'/../../fixtures/osrm_response_sample.xml'));

        foreach ($iterator as $i) {
            $this->assertInstanceOf('OsrmClient\Element\Node', $i);
            $this->assertInstanceOf('OsrmClient\Element\AttributeBag', $i->attributes);
            $this->assertInstanceOf('OsrmClient\Element\TagBag', $i->tags);
        }

        $nodes = iterator_to_array($iterator);
        $this->assertEquals(
            $nodes[2],
            new Node(
                new AttributeBag([
                    'id' => '252604389',
                    'lat' => '48.8656637',
                    'lon' => '2.3778893'
                ]),
                new TagBag([
                    'amenity' => 'bar',
                    'cuisine' => 'french',
                    'name' => 'Chez Justine',
                    'opening_hours' => 'Mo-Su 8:00-2:00',
                    'phone' => '01 43 57 44 03',
                    'website' => 'http://www.chezjustine.fr/',
                ])
            )
        );
    }
}
