<?php

namespace DrinkLocator\Elasticsearch;

use Dunglas\ApiBundle\Event\Events;
use Dunglas\ApiBundle\Event\DataEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Elastica\Type;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use DrinkLocator\Elasticsearch\DataTransformer\BarOrPub as BarOrPubTransformer;

/**
 * Bridges between Doctrine and DunglasApiBundle.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class EventSubscriber implements EventSubscriberInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;
    /**
     * @var Type
     */
    private $type;
    /**
     * @var BarOrPubTransformer
     */
    private $dataTransformer;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(EventDispatcherInterface $eventDispatcher, Type $type, BarOrPubTransformer $dataTransformer, LoggerInterface $logger = null)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->type = $type;
        $this->dataTransformer = $dataTransformer;
        $this->logger = $logger ?: new NullLogger();
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            Events::PRE_CREATE => ['persistObject', 0],
            Events::PRE_UPDATE => ['updateObject', 0],
            Events::PRE_DELETE => ['deleteObject', 0],
        ];
    }

    /**
     * Persists the given object and flushes.
     *
     * @param DataEvent $event
     */
    public function persistObject(DataEvent $event)
    {
        $barOrPub = $event->getData();
        $document = $this->dataTransformer->reverseTransform($barOrPub);

        $this->type->addDocument($document);

        $barOrPub->setId($document->getId());
        $this->eventDispatcher->dispatch(Events::POST_CREATE, $event);
        $event->stopPropagation();
    }

    /**
     * Updates the given object and flushes.
     *
     * @param DataEvent $event
     */
    public function updateObject(DataEvent $event)
    {
        $barOrPub = $event->getData();
        $document = $this->dataTransformer->reverseTransform($barOrPub);

        $this->type->updateDocument($document);

        $this->eventDispatcher->dispatch(Events::POST_UPDATE, $event);
        $event->stopPropagation();
    }

    /**
     * Removes the given object and flushes.
     *
     * @param DataEvent $event
     */
    public function deleteObject(DataEvent $event)
    {
        $barOrPub = $event->getData();

        $this->type->deleteById($barOrPub->getId());

        $this->eventDispatcher->dispatch(Events::POST_DELETE, $event);
        $event->stopPropagation();
    }
}
