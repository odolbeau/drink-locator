<?php

namespace DrinkLocator\Search\DataTransformer;

use Prophecy\Argument;
use DrinkLocator\Search\DataTransformer\BarOrPub;
use DrinkLocator\Entity\BarOrPub as BarOrPubEntity;
use Elastica\Document;
use DrinkLocator\Entity\GeoCoordinates;
use DrinkLocator\Entity\PostalAddress;

class BarOrPubTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_is_initializable()
    {
        $mapper = new BarOrPub();

        $this->assertInstanceOf('DrinkLocator\Search\DataTransformer\BarOrPub', $mapper);
    }

    public function test_transform()
    {
        $document = Document::create([
            'id' => '702916141',
            'lat' => '48.8567788',
            'lon' => '2.3558116',
            'addr' => [
                'housenumber' => '4',
                'street' => 'Rue du Bourg Tibourg',
            ],
            'amenity' => 'bar',
            'name' => 'Feria Café',
            'phone' => '01 42 72 43 99',
            'source' => 'cadastre-dgi-fr source : Direction Générale des Impôts - Cadastre. Mise à jour : 2010',
        ]);

        $coordinates = new GeoCoordinates();
        $coordinates->setLatitude('48.8567788');
        $coordinates->setLongitude('2.3558116');

        $postalAddress = new PostalAddress();
        $postalAddress->setStreetAddress('4 Rue du Bourg Tibourg');

        $expectedBarOrPub = new BarOrPubEntity();
        $expectedBarOrPub->setId(702916141);
        $expectedBarOrPub->setName('Feria Café');
        $expectedBarOrPub->setGeo($coordinates);
        $expectedBarOrPub->setAddress($postalAddress);
        $expectedBarOrPub->setTelephone('01 42 72 43 99');

        $mapper = new BarOrPub();
        $this->assertEquals($expectedBarOrPub, $mapper->transform($document));
    }
}
