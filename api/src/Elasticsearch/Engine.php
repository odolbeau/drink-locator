<?php

namespace DrinkLocator\Elasticsearch;

use Elastica\Type;
use DrinkLocator\Elasticsearch\DataTransformer\BarOrPub;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Elastica\Exception\NotFoundException as ElasticaNotFoundException;
use DrinkLocator\Exception\NotFoundException;

class Engine
{
    private $type;
    private $dataTransformer;

    public function __construct(Type $type, BarOrPub $dataTransformer, LoggerInterface $logger = null)
    {
        $this->type = $type;
        $this->dataTransformer = $dataTransformer;
        $this->logger = $logger ?: new NullLogger();
    }

    /**
     * findOne
     *
     * @param int $id
     *
     * @return BarOrPub
     */
    public function findOne($id)
    {
        try {
            $document = $this->type->getDocument($id);
        } catch (ElasticaNotFoundException $e) {
            $this->logger->debug('Document #{id} not found.', ['exception' => $e, 'id' => $id]);

            throw new NotFoundException($e);
        }

        return $this->dataTransformer->transform($document);
    }
}
