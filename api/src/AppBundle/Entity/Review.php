<?php

namespace AppBundle\Entity;

use Dunglas\ApiBundle\Annotation\Iri;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A review of an item - for example, of a restaurant, movie, or store.
 * 
 * @see http://schema.org/Review Documentation on Schema.org
 * @Iri("http://schema.org/Review")
 */
class Review extends CreativeWork
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
     * @var string The actual body of the review.
     * 
     * @Assert\Type(type="string")
     * @Iri("https://schema.org/reviewBody")
     */
    private $reviewBody;
    /**
     * @var Rating The rating given in this review. Note that reviews can themselves be rated. The `reviewRating` applies to rating given by the review. The `aggregateRating` property applies to the review itself, as a creative work.
     * 
     * @Iri("https://schema.org/reviewRating")
     */
    private $reviewRating;

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
     * Sets reviewBody.
     * 
     * @param string $reviewBody
     * 
     * @return $this
     */
    public function setReviewBody($reviewBody)
    {
        $this->reviewBody = $reviewBody;

        return $this;
    }

    /**
     * Gets reviewBody.
     * 
     * @return string
     */
    public function getReviewBody()
    {
        return $this->reviewBody;
    }

    /**
     * Sets reviewRating.
     * 
     * @param Rating $reviewRating
     * 
     * @return $this
     */
    public function setReviewRating(Rating $reviewRating = null)
    {
        $this->reviewRating = $reviewRating;

        return $this;
    }

    /**
     * Gets reviewRating.
     * 
     * @return Rating
     */
    public function getReviewRating()
    {
        return $this->reviewRating;
    }
}
