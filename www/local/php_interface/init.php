<?php

use Symfony\Component\Dotenv\Dotenv;

$root_path = rtrim($_SERVER['DOCUMENT_ROOT'] ?? '/home/bitrix/www', '/');
$init_path = rtrim(dirname(__FILE__), '/');
$home_path = sprintf('%s/../../..', $init_path);

// composer
if (is_file($_vendor_path = $home_path.'/vendor/autoload.php')) {
    require($_vendor_path);
}

// .env
$dotenv = new Dotenv();
$dotenv->bootEnv($home_path.'/.env');

/** Вспомогательные функции */
require($init_path.'/functions.php');