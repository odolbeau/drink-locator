<?php

namespace DrinkLocator\Entity;

use Dunglas\ApiBundle\Annotation\Iri;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The mailing address.
 *
 * @see http://schema.org/PostalAddress Documentation on Schema.org
 * @Iri("http://schema.org/PostalAddress")
 */
class PostalAddress extends ContactPoint
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string The locality. For example, Mountain View.
     *
     * @Assert\Type(type="string")
     * @Iri("https://schema.org/addressLocality")
     */
    private $addressLocality;
    /**
     * @var string The postal code. For example, 94043.
     *
     * @Assert\Type(type="string")
     * @Iri("https://schema.org/postalCode")
     */
    private $postalCode;
    /**
     * @var string The street address. For example, 1600 Amphitheatre Pkwy.
     *
     * @Assert\Type(type="string")
     * @Iri("https://schema.org/streetAddress")
     */
    private $streetAddress;

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

    /**
     * Sets addressLocality.
     *
     * @param string $addressLocality
     *
     * @return $this
     */
    public function setAddressLocality($addressLocality)
    {
        $this->addressLocality = $addressLocality;

        return $this;
    }

    /**
     * Gets addressLocality.
     *
     * @return string
     */
    public function getAddressLocality()
    {
        return $this->addressLocality;
    }

    /**
     * Sets postalCode.
     *
     * @param string $postalCode
     *
     * @return $this
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Gets postalCode.
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Sets streetAddress.
     *
     * @param string $streetAddress
     *
     * @return $this
     */
    public function setStreetAddress($streetAddress)
    {
        $this->streetAddress = $streetAddress;

        return $this;
    }

    /**
     * Gets streetAddress.
     *
     * @return string
     */
    public function getStreetAddress()
    {
        return $this->streetAddress;
    }
}
