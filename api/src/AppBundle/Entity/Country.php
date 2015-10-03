<?php

namespace AppBundle\Entity;

use Dunglas\ApiBundle\Annotation\Iri;

/**
 * A country.
 * 
 * @see http://schema.org/Country Documentation on Schema.org
 * @Iri("http://schema.org/Country")
 */
class Country extends AdministrativeArea
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
