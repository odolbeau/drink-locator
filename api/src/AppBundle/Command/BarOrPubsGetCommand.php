<?php

namespace DrinkLocator\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class BarOrPubsGetCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('bar_or_pubs:get')
            ->setDescription('Use the search engine to find a bar or a pub in ES.')
            ->addArgument('id', InputArgument::OPTIONAL, 'The id to retrieve.')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (null === $input->getArgument('id')) {
            throw new \Exception('Not implemented');
        }

        $id = (int) $input->getArgument('id');

        $barOrPub = $this->getContainer()->get('search.engine')->findOne($id);
        $content = $this->getContainer()->get('serializer')->normalize($barOrPub);

        $output->writeln("<comment>Bar/Pub #<info>$id</info> found in ElasticSearch:</comment>");
        $output->writeln(json_encode($content, JSON_PRETTY_PRINT));
    }
}
