<?php

namespace Bab\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use OsrmClient\OverpassAPI\Client;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Bab\Indexer;

class ImportCommand extends Command
{
    protected $client;

    public function __construct(Client $client, Indexer $indexer, LoggerInterface $logger = null)
    {
        $this->client = $client;
        $this->indexer = $indexer;
        $this->logger = $logger ?: new NullLogger();

        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('import')
            ->setDescription('Import data from OSRM.')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->logger->info('Start importing OSRM bars');

        $iterator = $this->client->search('node(48.815465,2.248614,48.907167,2.422335)["amenity"="bar"]; node(48.815465,2.248614,48.907167,2.422335)["amenity"="pub"]; out body;');

        $this->indexer->index($iterator);
    }
}
