<?php

require_once 'Services/RandomValueGenerator.php';
require_once 'TestStatus.php';

use Services\RandomValueGenerator;

class Test
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = new mysqli('host', 'user', 'password', 'db', 'port');
    }

    /**
     * Заполнить таблицу случайным набором данных
     *
     * @return void
     */
    private function fill()
    {
        $generator = new RandomValueGenerator();

        $query = "INSERT INTO `tests` (`script_name`, `start_time`, `end_time`, `result`) values(?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);

        for ($i = 0; $i < 10; $i++) {
            $script_name = $generator->text();
            $start_time = $generator->number(0, 100);
            $end_time = $generator->number(0, 100);
            $result = $generator->randomArrayItem([
                TestStatus::NORMAL, TestStatus::ILLEGAL,
                TestStatus::FAILED, TestStatus::SUCCESS
            ]);

            $stmt->bind_param('siis', $script_name, $start_time, $end_time, $result);
            $stmt->execute();
        }
    }

    /**
     * Получить список тестов со статусом 'normal', 'success'
     *
     * @return array[]
     */
    public function get(): array
    {
        $rows = [];
        $query = "SELECT * FROM `tests` WHERE `result` IN (?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('ss', ...[TestStatus::NORMAL, TestStatus::SUCCESS]);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        mysqli_free_result($result);
        return $rows;
    }

}
