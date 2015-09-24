<?php

namespace OsrmClient\Iterator;

use OsrmClient\Element\Node;
use OsrmClient\Element\AttributeBag;
use OsrmClient\Element\TagBag;

class Osm3sXmlIterator implements \Iterator, \Countable
{
    protected $iterator;

    public function __construct($string)
    {
        $this->iterator = new \ArrayIterator((new \SimpleXMLElement($string))->xpath('node'));
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        $xmlElement = $this->iterator->current();

        $attributes = [];
        foreach ($xmlElement->attributes() as $key => $value) {
            $attributes[$key] = (string) $value;
        }

        $tags = [];
        foreach ($xmlElement->xpath('tag') as $tag) {
            $tags[(string) $tag->attributes()['k']] = (string) $tag->attributes()['v'];
        }

        return new Node(
            new AttributeBag($attributes),
            new TagBag($tags)
        );
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return $this->iterator->key();
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        return $this->iterator->next();
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        return $this->iterator->rewind();
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        return $this->iterator->valid();
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return $this->iterator->count();
    }
}
