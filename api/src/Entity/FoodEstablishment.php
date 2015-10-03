<?php

namespace DrinkLocator\Entity;

use Dunglas\ApiBundle\Annotation\Iri;

/**
 * A food-related business.
 * 
 * @see http://schema.org/FoodEstablishment Documentation on Schema.org
 * @Iri("http://schema.org/FoodEstablishment")
 */
abstract class FoodEstablishment extends LocalBusiness
{
}
