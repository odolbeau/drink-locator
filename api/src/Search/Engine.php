<?php

namespace DrinkLocator\Search;

use Elastica\Type;
use DrinkLocator\Search\DataTransformer\BarOrPub;

class Engine
{
    private $type;
    private $dataTransformer;

    public function __construct(Type $type, BarOrPub $dataTransformer)
    {
        $this->type = $type;
        $this->dataTransformer = $dataTransformer;
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
        $document = $this->type->getDocument($id);

        return $this->dataTransformer->transform($document);
    }
}
