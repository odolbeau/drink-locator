<?php

namespace AppBundle\DataProvider;

use Dunglas\ApiBundle\Api\ResourceInterface;
use Dunglas\ApiBundle\Model\DataProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\BarOrPub;

/**
 * Data provider for Elasticsearch.
 */
class ElasticsearchDataProvider implements DataProviderInterface
{
    private $data;

    public function __construct()
    {
        $this->data = [
            'bar1' => new BarOrPub(),
            'bar2' => new BarOrPub(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getItem(ResourceInterface $resource, $id, $fetchData = false)
    {
        return isset($this->data[$id]) ? $this->data[$id] : null;
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
        return 'AppBundle\Entity\BarOrPub' === $resource->getEntityClass();
    }
}
