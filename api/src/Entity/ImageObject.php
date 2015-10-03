<?php

namespace DrinkLocator\Entity;

use Dunglas\ApiBundle\Annotation\Iri;

/**
 * An image file.
 * 
 * @see http://schema.org/ImageObject Documentation on Schema.org
 * @Iri("http://schema.org/ImageObject")
 */
class ImageObject extends MediaObject
{
    /**
     * @var int
     */
    private $id;

    /**
     * Sets id.
     * 
     * @param int $id
     * 
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets id.
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
