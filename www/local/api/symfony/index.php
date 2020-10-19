<?php
define('EXTRANET_NO_REDIRECT', true);
define('NOT_CHECK_PERMISSIONS', true);

use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

$root = rtrim($_SERVER['DOCUMENT_ROOT'], '/');

// include bitrix
require_once(sprintf('%s/bitrix/modules/main/include/prolog_before.php', $root));

if ($_SERVER['APP_DEBUG']) {
    umask(0000);

    // Debug::enable();
}

if (!isset($_SERVER['HTTP_REFERER'])) {
    $_SERVER['HTTP_REFERER'] = null;
}

if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? false) {
    Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_ALL ^ Request::HEADER_X_FORWARDED_HOST);
}

if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? false) {
    Request::setTrustedHosts([$trustedHosts]);
}

$request = Request::createFromGlobals();
$response = symfony(false)->handle($request);
$response->send();
symfony()->terminate($request, $response);
