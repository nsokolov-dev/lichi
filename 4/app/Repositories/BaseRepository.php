<?php

namespace App\Repositories;

use mysqli;

abstract class BaseRepository implements RepositoryInterface
{
    private static ?mysqli $db = null;

    private array $cache = [];

    public function __construct()
    {
        if (!static::$db) {
            static::$db = new mysqli(
                CONFIG['database']['hostname'],
                CONFIG['database']['username'],
                CONFIG['database']['password'],
                CONFIG['database']['database'],
                CONFIG['database']['port']
            );
        }
    }

    /**
     * Получить инстанс базы данных
     *
     * @return \mysqli
     */
    protected function db(): mysqli
    {
        return static::$db;
    }

    /**
     * Получить данные из кеша, или записать кеш и вернуть данные
     *
     * @param string $key
     * @param callable $callback
     * @return mixed
     */
    protected function getOrStoreCache(string $key, callable $callback)
    {
        if (isset($this->cache[$key])) {
            return $this->cache[$key];
        }

        $this->cache[$key] = $callback();
        return $this->cache[$key];
    }

    /**
     * Выполнить запрос к базе данных
     *
     * @param string $query
     * @param string $types
     * @param ...$params
     * @return false|\mysqli_result
     */
    protected function query(string $query, string $types = '', ...$params)
    {
        $stmt = $this->db()->prepare($query);

        if ($types)
            $stmt->bind_param($types, ...$params);
        $stmt->execute();

        return $stmt->get_result();
    }

    /**
     * Получить плейсхолдер для запроса
     *
     * @param array $params
     * @return string
     */
    protected function queryPlaceholder(array $params): string
    {
        return implode(', ', array_fill(0, count($params), '?'));
    }

    /**
     * Получить значения для запроса
     *
     * @param array $params
     * @return string
     */
    protected function queryValues(array $params): string
    {
        $values = [];
        foreach (array_keys($params) as $key) {
            $values[] = $key . ' = ?';
        }
        return implode(', ', $values);
    }
}
