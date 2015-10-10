<?php

namespace DrinkLocator\Entity;

use Dunglas\ApiBundle\Annotation\Iri;

/**
 * Structured values are used when the value of a property has a more complex structure than simply being a textual value or a reference to another thing.
 *
 * @see http://schema.org/StructuredValue Documentation on Schema.org
 * @Iri("http://schema.org/StructuredValue")
 */
abstract class StructuredValue extends Intangible
{
}
