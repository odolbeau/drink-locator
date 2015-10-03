<?php

namespace AppBundle\Entity;

use Dunglas\ApiBundle\Annotation\Iri;

/**
 * The most generic kind of creative work, including books, movies, photographs, software programs, etc.
 * 
 * @see http://schema.org/CreativeWork Documentation on Schema.org
 * @Iri("http://schema.org/CreativeWork")
 */
abstract class CreativeWork extends Thing
{
}
