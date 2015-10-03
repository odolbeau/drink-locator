<?php

namespace AppBundle\Entity;

use Dunglas\ApiBundle\Annotation\Iri;

/**
 * A bar or pub.
 * 
 * @see http://schema.org/BarOrPub Documentation on Schema.org
 * @Iri("http://schema.org/BarOrPub")
 */
class BarOrPub extends FoodEstablishment
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
