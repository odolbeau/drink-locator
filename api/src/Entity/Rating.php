<?php

namespace DrinkLocator\Entity;

use Dunglas\ApiBundle\Annotation\Iri;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A rating is an evaluation on a numeric scale, such as 1 to 5 stars.
 *
 * @see http://schema.org/Rating Documentation on Schema.org
 * @Iri("http://schema.org/Rating")
 */
abstract class Rating extends Intangible
{
    /**
     * @var float The highest value allowed in this rating system. If bestRating is omitted, 5 is assumed.
     *
     * @Assert\Type(type="float")
     * @Iri("https://schema.org/bestRating")
     */
    private $bestRating;
    /**
     * @var string The rating for the content.
     *
     * @Assert\Type(type="string")
     * @Iri("https://schema.org/ratingValue")
     */
    private $ratingValue;
    /**
     * @var float
     *
     * @Assert\Type(type="float")
     * @Assert\NotNull
     */
    private $worstRatng;

    /**
     * Sets bestRating.
     *
     * @param float $bestRating
     *
     * @return $this
     */
    public function setBestRating($bestRating)
    {
        $this->bestRating = $bestRating;

        return $this;
    }

    /**
     * Gets bestRating.
     *
     * @return float
     */
    public function getBestRating()
    {
        return $this->bestRating;
    }

    /**
     * Sets ratingValue.
     *
     * @param string $ratingValue
     *
     * @return $this
     */
    public function setRatingValue($ratingValue)
    {
        $this->ratingValue = $ratingValue;

        return $this;
    }

    /**
     * Gets ratingValue.
     *
     * @return string
     */
    public function getRatingValue()
    {
        return $this->ratingValue;
    }

    /**
     * Sets worstRatng.
     *
     * @param float $worstRatng
     *
     * @return $this
     */
    public function setWorstRatng($worstRatng)
    {
        $this->worstRatng = $worstRatng;

        return $this;
    }

    /**
     * Gets worstRatng.
     *
     * @return float
     */
    public function getWorstRatng()
    {
        return $this->worstRatng;
    }
}
