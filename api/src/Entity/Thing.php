<?php

namespace DrinkLocator\Entity;

use Dunglas\ApiBundle\Annotation\Iri;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The most generic type of item.
 *
 * @see http://schema.org/Thing Documentation on Schema.org
 * @Iri("http://schema.org/Thing")
 */
abstract class Thing
{
    /**
     * @var string A short description of the item.
     *
     * @Assert\Type(type="string")
     * @Iri("https://schema.org/description")
     */
    private $description;
    /**
     * @var string The name of the item.
     *
     * @Assert\Type(type="string")
     * @Iri("https://schema.org/name")
     */
    private $name;
    /**
     * @var string URL of the item.
     *
     * @Assert\Url
     * @Iri("https://schema.org/url")
     */
    private $url;

    /**
     * Sets description.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Gets description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets name.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets url.
     *
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Gets url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
