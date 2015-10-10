<?php

namespace DrinkLocator\AppBundle\DataProvider;

use Dunglas\ApiBundle\Api\ResourceInterface;
use Dunglas\ApiBundle\Model\DataProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use DrinkLocator\Entity\BarOrPub;
use DrinkLocator\Search\Engine;
use DrinkLocator\Exception\NotFoundException;

/**
 * Data provider for Elasticsearch.
 */
class ElasticsearchDataProvider implements DataProviderInterface
{
    private $searchEngine;

    public function __construct(Engine $searchEngine)
    {
        $this->searchEngine = $searchEngine;
    }

    /**
     * {@inheritdoc}
     */
    public function getItem(ResourceInterface $resource, $id, $fetchData = false)
    {
        try {
            $barOrPub = $this->searchEngine->findOne($id);
        } catch (NotFoundException $e) {
            return;
        }

        switch ($resource->getShortName()) {
            case 'BarOrPub':
                return $barOrPub;

            case 'GeoCoordinates':
                return $barOrPub->getGeo();

            case 'PostalAddress':
                return $barOrPub->getAddress();

            default:
                throw new \InvalidArgumentException('Doesn\'t support '.$resource->getShortName().'.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCollection(ResourceInterface $resource, Request $request)
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(ResourceInterface $resource)
    {
        return in_array($resource->getEntityClass(), [
            'DrinkLocator\Entity\BarOrPub',
            'DrinkLocator\Entity\GeoCoordinates',
            'DrinkLocator\Entity\PostalAddress',
        ]);
    }
}
