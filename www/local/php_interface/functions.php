<?php

use App\Kernel;
use Bitrix\Highloadblock\HighloadBlockTable;

/**
 * @param string $key
 * @param mixed $default
 *
 * @return mixed
 */
function env(string $key, $default = null)
{
    return isset($_ENV[$key]) && !empty($_ENV[$key]) ? $_ENV[$key] : $default;
}

/**
 * @return bool
 */
function isDev(): bool
{
    return env('APP_ENV') === 'dev' || empty(env('APP_ENV'));
}

/**
 * @return bool
 */
function isProd(): bool
{
    return !isDev();
}

/**
 * @param mixed $id
 *
 * @return object|mixed|null
 */
function service($id)
{
    return symfony()->getContainer()->get($id);
}

/**
 * semantic
 *
 * @param mixed $id
 *
 * @return object|mixed|null
 */
function instance($id)
{
    return service($id);
}

/**
 * @param bool $boot
 *
 * @return Kernel|null
 */
function symfony(bool $boot = true): ?Kernel
{
    global $symfony;

    if (!$symfony) {
        $symfony = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
    }

    if ($boot) {
        $symfony->boot();
    }

    return $symfony;
}

/**
 * @param int|array $id
 *
 * @return string|array|null
 */
function getGroupCodeById($id)
{
    $query = CGroup::GetList(($by = 'ID'), ($order = 'ASC'),
        ['ID' => is_array($id) ? implode('|', $id) : $id]);
    $result = [];

    while ($item = $query->Fetch()) {
        if (is_array($id)) {
            $result[] = $item['STRING_ID'];
        } else {
            return empty($item['STRING_ID']) ? null : $item['STRING_ID'];
        }
    }

    return is_array($id) ? array_filter($result) : null;
}

/**
 * @param string|array $code
 *
 * @return string|array|null
 */
function getGroupIdByCode($code)
{
    $query = CGroup::GetList(($by = 'ID'), ($order = 'ASC'),
        ['STRING_ID' => is_array($code) ? implode('|', $code) : $code]);
    $result = [];

    while ($item = $query->Fetch()) {
        if (is_array($code)) {
            $result[] = (int)$item['ID'];
        } else {
            return (int)$item['ID'];
        }
    }

    return is_array($code) ? array_filter($result) : null;
}

/**
 * @param int $id
 *
 * @return string|null
 */
function getIblockCodeById($id): ?string
{
    if ($item = CIBlock::GetByID($id)->Fetch()) {
        return $item['CODE'];
    }

    return null;
}

/**
 * @param string $code
 * @param string|null $type
 *
 * @return int|null
 */
function getIblockIdByCode(string $code, ?string $type = null): ?int
{
    if ($item = CIBlock::GetList([], ['CODE' => $code, 'TYPE' => $type])->Fetch()) {
        return (int)$item['ID'];
    }

    return null;
}

/**
 * @throws \Bitrix\Main\ArgumentException
 * @throws \Bitrix\Main\ObjectPropertyException
 * @throws \Bitrix\Main\SystemException
 *
 * @param string $name
 * @return int|null
 */
function getHLIdByName(string $name): ?int
{
    if ($item = HighloadBlockTable::getList(['filter' => ['NAME' => $name]])->fetch()) {
        return (int)$item['ID'];
    }

    return null;
}

/**
 * @throws \Bitrix\Main\ArgumentException
 * @throws \Bitrix\Main\ObjectPropertyException
 * @throws \Bitrix\Main\SystemException
 *
 * @param int $id
 * @return string|null
 */
function getHLNameById(int $id): ?string
{
    if ($item = HighloadBlockTable::getById($id)->fetch()) {
        return $item['NAME'];
    }

    return null;
}