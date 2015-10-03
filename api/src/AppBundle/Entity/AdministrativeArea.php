<?php

namespace AppBundle\Entity;

use Dunglas\ApiBundle\Annotation\Iri;

/**
 * A geographical region under the jurisdiction of a particular government.
 * 
 * @see http://schema.org/AdministrativeArea Documentation on Schema.org
 * @Iri("http://schema.org/AdministrativeArea")
 */
abstract class AdministrativeArea extends Place
{
}
