<?php

namespace AppBundle\Entity;

use Dunglas\ApiBundle\Annotation\Iri;

/**
 * A utility class that serves as the umbrella for a number of 'intangible' things such as quantities, structured values, etc.
 * 
 * @see http://schema.org/Intangible Documentation on Schema.org
 * @Iri("http://schema.org/Intangible")
 */
abstract class Intangible extends Thing
{
}
