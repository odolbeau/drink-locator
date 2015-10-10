<?php

namespace DrinkLocator\Entity;

use Dunglas\ApiBundle\Annotation\Iri;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The geographic coordinates of a place or event.
 *
 * @see http://schema.org/GeoCoordinates Documentation on Schema.org
 * @Iri("http://schema.org/GeoCoordinates")
 */
class GeoCoordinates extends StructuredValue
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var float The latitude of a location. For example `37.42242`.
     *
     * @Assert\Type(type="float")
     * @Iri("https://schema.org/latitude")
     */
    private $latitude;
    /**
     * @var float The longitude of a location. For example `-122.08585`.
     *
     * @Assert\Type(type="float")
     * @Iri("https://schema.org/longitude")
     */
    private $longitude;

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
     * Sets latitude.
     *
     * @param float $latitude
     *
     * @return $this
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Gets latitude.
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Sets longitude.
     *
     * @param float $longitude
     *
     * @return $this
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Gets longitude.
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
}
