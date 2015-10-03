<?php

namespace DrinkLocator\AppBundle\DataProvider;

use Dunglas\ApiBundle\Api\ResourceInterface;
use Dunglas\ApiBundle\Model\DataProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use DrinkLocator\Entity\BarOrPub;
use DrinkLocator\Search\Engine;

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
        return $this->searchEngine->findOne($id);
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
        return 'DrinkLocator\Entity\BarOrPub' === $resource->getEntityClass();
    }
}
