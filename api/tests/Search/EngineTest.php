<?php

namespace DrinkLocator\Search;

use Prophecy\Argument;
use DrinkLocator\Search\Engine;
use Elastica\Document;
use DrinkLocator\Entity\BarOrPub;
use DrinkLocator\Entity\GeoCoordinates;
use DrinkLocator\Entity\PostalAddress;

class EngineTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_is_initializable()
    {
        $searchEngine = new Engine(
            $this->prophesize('Elastica\Type')->reveal(),
            $this->prophesize('DrinkLocator\Search\DataTransformer\BarOrPub')->reveal()
        );

        $this->assertInstanceOf('DrinkLocator\Search\Engine', $searchEngine);
    }

    public function test_find_one()
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

        $expectedBarOrPub = new BarOrPub();
        $expectedBarOrPub->setId(702916141);
        $expectedBarOrPub->setName('Feria Café');
        $expectedBarOrPub->setGeo($coordinates);
        $expectedBarOrPub->setAddress($postalAddress);
        $expectedBarOrPub->setTelephone('01 42 72 43 99');

        $type = $this->prophesize('Elastica\Type');
        $type
            ->getDocument(Argument::exact(1))
            ->shouldBeCalled()
            ->willReturn($document)
        ;

        $dataTransformer = $this->prophesize('DrinkLocator\Search\DataTransformer\BarOrPub');
        $dataTransformer
            ->transform(Argument::exact($document))
            ->shouldBeCalled()
            ->willReturn($expectedBarOrPub)
        ;

        $searchEngine = new Engine($type->reveal(), $dataTransformer->reveal());

        $this->assertEquals($expectedBarOrPub, $searchEngine->findOne(1));
    }
}
