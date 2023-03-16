<?php

namespace Services;

class RandomValueGenerator
{
    /**
     * Получить случайную строку
     *
     * @param int $length
     * @return string
     */
    public function text(int $length = 25): string
    {
        $stub = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($stub), 0, $length);
    }

    /**
     * Получить случайное число
     *
     * @param int $min
     * @param int $max
     * @return int
     */
    public function number(int $min, int $max): int
    {
        return rand($min, $max);
    }

    /**
     * Получить случайный элемент массива
     *
     * @param string[] $items
     * @return string
     */
    public function randomArrayItem(array $items): string
    {
        return $items[array_rand($items)];
    }
}
