<?php

namespace DrinkLocator\Entity;

use Dunglas\ApiBundle\Annotation\Iri;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An image, video, or audio object embedded in a web page. Note that a creative work may have many media objects associated with it on the same web page. For example, a page about a single song (MusicRecording) may have a music video (VideoObject), and a high and low bandwidth audio stream (2 AudioObject's).
 *
 * @see http://schema.org/MediaObject Documentation on Schema.org
 * @Iri("http://schema.org/MediaObject")
 */
abstract class MediaObject extends CreativeWork
{
    /**
     * @var string Actual bytes of the media object, for example the image file or video file.
     *
     * @Assert\Url
     * @Iri("https://schema.org/contentUrl")
     */
    private $contentUrl;
    /**
     * @var \DateTime Date when this media object was uploaded to this site.
     *
     * @Assert\Date
     * @Iri("https://schema.org/uploadDate")
     */
    private $uploadDate;

    /**
     * Sets contentUrl.
     *
     * @param string $contentUrl
     *
     * @return $this
     */
    public function setContentUrl($contentUrl)
    {
        $this->contentUrl = $contentUrl;

        return $this;
    }

    /**
     * Gets contentUrl.
     *
     * @return string
     */
    public function getContentUrl()
    {
        return $this->contentUrl;
    }

    /**
     * Sets uploadDate.
     *
     * @param \DateTime $uploadDate
     *
     * @return $this
     */
    public function setUploadDate(\DateTime $uploadDate = null)
    {
        $this->uploadDate = $uploadDate;

        return $this;
    }

    /**
     * Gets uploadDate.
     *
     * @return \DateTime
     */
    public function getUploadDate()
    {
        return $this->uploadDate;
    }
}
