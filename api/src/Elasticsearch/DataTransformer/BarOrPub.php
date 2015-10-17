<?php

namespace DrinkLocator\Elasticsearch\DataTransformer;

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
     *
     * @return BarOrPubEntity
     */
    public function transform(Document $document)
    {
        $data = $document->getData();

        $entity = new BarOrPubEntity();
        $entity->setId($data['id']);
        $entity->setName($data['name']);

        $this->transformGeoCoordinates($entity, $data);
        $this->transformPostalAddress($entity, $data);

        if (isset($data['phone'])) {
            $entity->setTelephone($data['phone']);
        }

        return $entity;
    }

    /**
     * reverseTransform
     *
     * @param BarOrPubEntity $barOrPub
     *
     * @return Document
     */
    public function reverseTransform(BarOrPubEntity $barOrPub)
    {
        $id = $barOrPub->getId() ?: uniqid('dl_');
        $data['id'] = $id;
        $data['name'] = $barOrPub->getName();

        if (null !== $geo = $barOrPub->getGeo()) {
            $data['lat'] = $geo->getLatitude();
            $data['lon'] = $geo->getLongitude();
        }

        if (null !== $address = $barOrPub->getAddress()) {
            $addressData = [];
            if (null !== $streeAddress = $address->getStreetAddress()) {
                $parts = explode(' ', $streeAddress);
                $addressData['housenumber'] = array_shift($parts);
                $addressData['street'] = implode(' ', $parts);
            }
            if (null !== $city = $address->getAddressLocality()) {
                $addressData['city'] = $city;
            }
            if (null !== $postCode = $address->getPostalCode()) {
                $addressData['postcode'] = $postCode;
            }
            $data['addr'] = $addressData;
        }

        if (null !== $phone = $barOrPub->getTelephone()) {
            $data['phone'] = $phone;
        }

        return new Document($id, $data);
    }

    /**
     * Add GeoCoordinates if possible.
     *
     * @param BarOrPubEntity $entity
     * @param array $data
     *
     * @return void
     */
    private function transformGeoCoordinates(BarOrPubEntity $entity, array $data)
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
    private function transformPostalAddress(BarOrPubEntity $entity, array $data)
    {
        if (!isset($data['addr'])) {
            return;
        }

        $postalAddress = new PostalAddress();
        $postalAddress->setId($data['id']);
        $addr = $data['addr'];
        if (isset($addr['housenumber']) && isset($addr['street'])) {
            $postalAddress->setStreetAddress($addr['housenumber'].' '.$addr['street']);
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
