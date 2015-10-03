<?php

namespace AppBundle\Entity;

use Dunglas\ApiBundle\Annotation\Iri;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The average rating based on multiple ratings or reviews.
 * 
 * @see http://schema.org/AggregateRating Documentation on Schema.org
 * @Iri("http://schema.org/AggregateRating")
 */
class AggregateRating extends Rating
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var Thing The item that is being reviewed/rated.
     * 
     * @Iri("https://schema.org/itemReviewed")
     */
    private $itemReviewed;
    /**
     * @var int The count of total number of ratings.
     * 
     * @Assert\Type(type="integer")
     * @Iri("https://schema.org/ratingCount")
     */
    private $ratingCount;
    /**
     * @var int The count of total number of reviews.
     * 
     * @Assert\Type(type="integer")
     * @Iri("https://schema.org/reviewCount")
     */
    private $reviewCount;

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
     * Sets itemReviewed.
     * 
     * @param Thing $itemReviewed
     * 
     * @return $this
     */
    public function setItemReviewed(Thing $itemReviewed = null)
    {
        $this->itemReviewed = $itemReviewed;

        return $this;
    }

    /**
     * Gets itemReviewed.
     * 
     * @return Thing
     */
    public function getItemReviewed()
    {
        return $this->itemReviewed;
    }

    /**
     * Sets ratingCount.
     * 
     * @param int $ratingCount
     * 
     * @return $this
     */
    public function setRatingCount($ratingCount)
    {
        $this->ratingCount = $ratingCount;

        return $this;
    }

    /**
     * Gets ratingCount.
     * 
     * @return int
     */
    public function getRatingCount()
    {
        return $this->ratingCount;
    }

    /**
     * Sets reviewCount.
     * 
     * @param int $reviewCount
     * 
     * @return $this
     */
    public function setReviewCount($reviewCount)
    {
        $this->reviewCount = $reviewCount;

        return $this;
    }

    /**
     * Gets reviewCount.
     * 
     * @return int
     */
    public function getReviewCount()
    {
        return $this->reviewCount;
    }
}
