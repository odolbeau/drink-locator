<?php

namespace DrinkLocator\Entity;

use Dunglas\ApiBundle\Annotation\Iri;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A contact point—for example, a Customer Complaints department.
 * 
 * @see http://schema.org/ContactPoint Documentation on Schema.org
 * @Iri("http://schema.org/ContactPoint")
 */
abstract class ContactPoint extends StructuredValue
{
    /**
     * @var string Email address.
     * 
     * @Assert\Email
     * @Iri("https://schema.org/email")
     */
    private $email;

    /**
     * Sets email.
     * 
     * @param string $email
     * 
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets email.
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
