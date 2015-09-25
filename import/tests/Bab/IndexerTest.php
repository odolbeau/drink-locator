<?php

namespace Bab;

use Prophecy\Argument;
use Bab\Indexer;
use OsrmClient\Iterator\Osm3sXmlIterator;

class IndexerTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_is_initializable()
    {
        $indexer = new Indexer($this->prophesize('Elastica\Type')->reveal());

        $this->assertInstanceOf('Bab\Indexer', $indexer);
    }

    public function test_index()
    {
        $iterator = new Osm3sXmlIterator(file_get_contents(__DIR__.'/../fixtures/osrm_response_sample.xml'));

        $type = $this->prophesize('Elastica\Type');
        $type
            ->addDocument(Argument::type('Elastica\Document'))
            ->shouldBeCalledTimes(17)
        ;
        $indexer = new Indexer($type->reveal());

        $indexer->index($iterator);
    }
}
