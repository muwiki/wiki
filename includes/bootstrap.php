<?php

require_once __DIR__ . '/../vendor/autoload.php';

call_user_func(function () {
    $httpRequest = (new \Nette\Http\RequestFactory())->createHttpRequest();
    preg_match('~^(?:.*\.)?(?P<domain>\w+\.\w+)$~', $httpRequest->getUrl()->getHost(), $host);

    ini_set('session.save_path', __DIR__ . '/../sessions');
    session_set_cookie_params(60 * 60 * 24 * 14, '/', '.' . $host['domain']);
});

