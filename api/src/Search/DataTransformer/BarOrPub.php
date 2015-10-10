<?php

namespace DrinkLocator\Search\DataTransformer;

use Elastica\Document;
use DrinkLocator\Entity\BarOrPub as BarOrPubEntity;
use DrinkLocator\Entity\GeoCoordinates;
use DrinkLocator\Entity\PostalAddress;

class BarOrPub
{
    /**
     * transform
     *
     * @param Document $document
     * @access public
     * @return void
     */
    public function transform(Document $document)
    {
        $data = $document->getData();

        $entity = new BarOrPubEntity();
        $entity->setId($data['id']);
        $entity->setName($data['name']);

        $this->handleGeoCoordinates($entity, $data);
        $this->handlePostalAddress($entity, $data);

        if (isset($data['phone'])) {
            $entity->setTelephone($data['phone']);
        }

        return $entity;
    }

    /**
     * Add GeoCoordinates if possible.
     *
     * @param BarOrPubEntity $entity
     * @param array $data
     *
     * @return void
     */
    private function handleGeoCoordinates(BarOrPubEntity $entity, array $data)
    {
        if (!isset($data['lat']) || !isset($data['lon'])) {
            return;
        }

        $coordinates = new GeoCoordinates();
        $coordinates->setId($data['id']);
        $coordinates->setLatitude($data['lat']);
        $coordinates->setLongitude($data['lon']);

        $entity->setGeo($coordinates);
    }

    /**
     * Add PostalAddress if possible.
     *
     * @param BarOrPubEntity $entity
     * @param array $data
     *
     * @return void
     */
    private function handlePostalAddress(BarOrPubEntity $entity, array $data)
    {
        if (!isset($data['addr'])) {
            return;
        }

        $postalAddress = new PostalAddress();
        $postalAddress->setId($data['id']);
        $addr = $data['addr'];
        if (isset($addr['housenumber']) || isset($addr['street'])) {
            $parts = [];
            if (isset($addr['housenumber'])) {
                $parts[] = $addr['housenumber'];
            }
            if (isset($addr['street'])) {
                $parts[] = $addr['street'];
            }

            $postalAddress->setStreetAddress(implode(' ', $parts));
        }

        if (isset($addr['city'])) {
            $postalAddress->setAddressLocality($addr['city']);
        }

        if (isset($addr['postcode'])) {
            $postalAddress->setPostalCode($addr['postcode']);
        }

        $entity->setAddress($postalAddress);
    }
}
