<?php

namespace App\Services;

use mysqli;

class MigrationService
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = new mysqli(
            CONFIG['database']['hostname'],
            CONFIG['database']['username'],
            CONFIG['database']['password'],
            CONFIG['database']['database'],
            CONFIG['database']['port']
        );
    }

    /**
     * Выполнить миграцию базы данных
     *
     * @param string $query
     * @return bool|\mysqli_result
     */
    public function migrate(string $query) {
        return $this->connection->query($query);
    }
}
