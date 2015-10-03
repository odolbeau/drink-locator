<?php

namespace Bab;

use Elastica\Type;
use Elastica\Document;
use OsrmClient\Iterator\Osm3sXmlIterator;

class Indexer
{
    protected $type;
    protected $propertyFormatter;

    public function __construct(Type $type, PropertyFormatter $propertyFormatter)
    {
        $this->type = $type;
        $this->propertyFormatter = $propertyFormatter;
    }

    /**
     * index
     *
     * @param Osm3sXmlIterator $iterator
     *
     * @return void
     */
    public function index(Osm3sXmlIterator $iterator)
    {
        foreach ($iterator as $item) {
            $properties = array_merge($item->attributes->all(), $item->tags->all());
            $properties = $this->propertyFormatter->format($properties);
            $document = new Document($item->attributes['id'], $properties);

            $this->type->addDocument($document);
        }
    }
}
