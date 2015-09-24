<?php

namespace OsrmClient\Element;

class Node
{
    public $attributes;
    public $tags;

    public function __construct(AttributeBag $attributes, TagBag $tags)
    {
        $this->attributes = $attributes;
        $this->tags = $tags;
    }
}
