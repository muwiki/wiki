<?php

use MediaWiki\Logger\LoggerFactory;
use Nette\Http\RequestFactory;
use Tracy\Debugger;

require_once __DIR__ . '/vendor/autoload.php';

call_user_func(function () {
    Debugger::enable(Debugger::PRODUCTION, __DIR__ . '/logs');

    $domainRedirects = [
        'muwiki' => 'fi.muwiki',
        'www.muwiki' => 'fi.muwiki',
    ];

    $domainWhitelist = [
        'fi.muwiki',
    ];

    $httpRequest = (new RequestFactory())->createHttpRequest();
    $response = new \Nette\Http\Response();

    if (preg_match('~^(?:(?P<second>.+)\.)?(?P<first>\w+)\.(?P<tld>\w+)$~', $httpRequest->getUrl()->getHost(), $host)) {
        $host['domain'] = $host['first'] . $host['tld'];
        $host['withoutTld'] = (!empty($host['second']) ? $host['second'] . '.' : '') . $host['first'];

        if (PHP_SAPI !== 'cli') {
            if (array_key_exists($host['withoutTld'], $domainRedirects)) {
                $url = $httpRequest->getUrl();
                $url->setHost($domainRedirects[$host['withoutTld']] . '.' . $host['tld']);
                $response->redirect($url);
                exit;

            } elseif (!in_array($host['withoutTld'], $domainWhitelist, true)) {
                $response->setCode($response::S404_NOT_FOUND);
                require_once __DIR__ . '/public/4xx/404.html';
                exit;
            }
        }

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
