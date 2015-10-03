<?php

use Pimple\Container;
use Symfony\Component\EventDispatcher\EventDispatcher;
use OsrmClient\OverpassAPI\Client;
use Monolog\Processor\PsrLogMessageProcessor;
use Monolog\Logger;
use Symfony\Bridge\Monolog\Handler\ConsoleHandler;
use Symfony\Component\Yaml\Yaml;
use Bab\Indexer;
use Bab\PropertyFormatter;

$config = Yaml::parse(__DIR__.'/config/parameters.yml');

$c = new Container();

$c['dispatcher'] = function ($c) {
    $dispatcher = new EventDispatcher();
    $dispatcher->addSubscriber($c['monolog.handler.console']);

    return $dispatcher;
};

$c['osrm_client'] = function ($c) {
    return new OsrmClient\OverpassAPI\Client();
};
$c['logger'] = function ($c) {
    $logger = new Logger('main');
    $logger->pushProcessor(new PsrLogMessageProcessor());
    $logger->pushHandler($c['monolog.handler.console']);

    return $logger;
};
$c['monolog.handler.console'] = function ($c) {
    return new ConsoleHandler();
};
$c['indexer'] = function ($c) use ($config) {
    return new Indexer(
        new \Elastica\Type(
            new \Elastica\Index(
                new \Elastica\Client([
                    'host' => $config['elasticsearch']['host'],
                    'port' => $config['elasticsearch']['port']
                ]),
                $config['elasticsearch']['index']
            ),
            $config['elasticsearch']['type']
        ),
        new PropertyFormatter()
    );
};

return $c;
