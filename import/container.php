<?php

use Pimple\Container;
use Symfony\Component\EventDispatcher\EventDispatcher;
use OsrmClient\OverpassAPI\Client;
use Monolog\Processor\PsrLogMessageProcessor;
use Monolog\Logger;
use Symfony\Bridge\Monolog\Handler\ConsoleHandler;

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
    $logger = new Logger('main'); # Main channel, or whatever name you like.
    # PSR 3 log message formatting for all handlers
    $logger->pushProcessor(new PsrLogMessageProcessor());
    $logger->pushHandler($c['monolog.handler.console']);

    return $logger;
};
$c['monolog.handler.console'] = function ($c) {
    return new ConsoleHandler();
};

return $c;
