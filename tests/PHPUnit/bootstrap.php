<?php
define('NOT_CHECK_PERMISSIONS', true);

if (empty($_SERVER['DOCUMENT_ROOT'])) {
    $_SERVER['DOCUMENT_ROOT'] = '/home/bitrix/www';
}

require(sprintf('%s/bitrix/modules/main/include/prolog_before.php', rtrim($_SERVER['DOCUMENT_ROOT'], '/')));
