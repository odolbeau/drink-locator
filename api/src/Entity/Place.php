<?php

namespace DrinkLocator\Entity;

use Dunglas\ApiBundle\Annotation\Iri;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entities that have a somewhat fixed, physical extension.
 * 
 * @see http://schema.org/Place Documentation on Schema.org
 * @Iri("http://schema.org/Place")
 */
abstract class Place extends Thing
{
    /**
     * @var PostalAddress Physical address of the item.
     * 
     * @Iri("https://schema.org/address")
     */
    private $address;
    /**
     * @var AggregateRating The overall rating, based on a collection of reviews or ratings, of the item.
     * 
     * @Iri("https://schema.org/aggregateRating")
     */
    private $aggregateRating;
    /**
     * @var GeoCoordinates The geo coordinates of the place.
     * 
     * @Iri("https://schema.org/geo")
     */
    private $geo;
    /**
     * @var ImageObject A photograph of this place.
     * 
     * @Iri("https://schema.org/photo")
     */
    private $photo;
    /**
     * @var Review A review of the item.
     * 
     * @Iri("https://schema.org/review")
     */
    private $review;
    /**
     * @var string The telephone number.
     * 
     * @Assert\Type(type="string")
     * @Iri("https://schema.org/telephone")
     */
    private $telephone;

    /**
     * Sets address.
     * 
     * @param PostalAddress $address
     * 
     * @return $this
     */
    public function setAddress(PostalAddress $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Gets address.
     * 
     * @return PostalAddress
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets aggregateRating.
     * 
     * @param AggregateRating $aggregateRating
     * 
     * @return $this
     */
    public function setAggregateRating(AggregateRating $aggregateRating = null)
    {
        $this->aggregateRating = $aggregateRating;

        return $this;
    }

    /**
     * Gets aggregateRating.
     * 
     * @return AggregateRating
     */
    public function getAggregateRating()
    {
        return $this->aggregateRating;
    }

    /**
     * Sets geo.
     * 
     * @param GeoCoordinates $geo
     * 
     * @return $this
     */
    public function setGeo(GeoCoordinates $geo = null)
    {
        $this->geo = $geo;

        return $this;
    }

    /**
     * Gets geo.
     * 
     * @return GeoCoordinates
     */
    public function getGeo()
    {
        return $this->geo;
    }

    /**
     * Sets photo.
     * 
     * @param ImageObject $photo
     * 
     * @return $this
     */
    public function setPhoto(ImageObject $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Gets photo.
     * 
     * @return ImageObject
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Sets review.
     * 
     * @param Review $review
     * 
     * @return $this
     */
    public function setReview(Review $review = null)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Gets review.
     * 
     * @return Review
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Sets telephone.
     * 
     * @param string $telephone
     * 
     * @return $this
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Gets telephone.
     * 
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
}
