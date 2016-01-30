<?php

use MediaWiki\Logger\LoggerFactory;
use Nette\Http\RequestFactory;
use Tracy\Debugger;

require_once __DIR__ . '/vendor/autoload.php';

call_user_func(function () {
    Debugger::enable(Debugger::PRODUCTION, __DIR__ . '/logs');

    $httpRequest = (new RequestFactory())->createHttpRequest();
    if (preg_match('~^(?:.*\.)?(?P<domain>\w+\.\w+)$~', $httpRequest->getUrl()->getHost(), $host)) {
        session_set_cookie_params(60 * 60 * 24 * 14, '/', '.' . $host['domain'], TRUE, TRUE);
    }
    ini_set('session.save_path', __DIR__ . '/temp');

    $logger = new \Kdyby\Monolog\Logger('mediawiki');
    $logger->pushProcessor(new Kdyby\Monolog\Processor\PriorityProcessor());
    $logger->pushProcessor(new Kdyby\Monolog\Processor\TracyExceptionProcessor(Debugger::$logDirectory));
    $logger->pushHandler(new Kdyby\Monolog\Handler\FallbackNetteHandler($logger->getName(), \Tracy\Debugger::$logDirectory, FALSE, $logger::WARNING));

    Debugger::setLogger(new \Kdyby\Monolog\Diagnostics\MonologAdapter($logger));
    LoggerFactory::registerProvider(new \MediaWiki\Logger\InstanceSpi($logger));

    // expose globals
    $GLOBALS['monologLogger'] = $logger;
    $GLOBALS['httpRequest'] = $httpRequest;
    $GLOBALS['IP'] = __DIR__;
});
