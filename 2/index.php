<?php

/**
 * Получить массив недопустимых частей числа
 *
 * @return string[]
 */
function getInvalidParts(): array
{
    $values = [];
    $range = implode('', range(0, 9));

    for ($i = 0; $i < 8; $i++) {
        $values[] = substr($range, $i, 3);
    }

    return $values;
}

/**
 * Проверить, содержит ли $value недопустимые части
 *
 * @param int $value
 * @param string[] $invalidParts
 * @return bool
 */
function isValidValue(int $value, array $invalidParts): bool
{
    $valid = true;

    foreach ($invalidParts as $invalidPart) {
        if (strpos($value, $invalidPart) !== false) {
            $valid = false;
            break;
        }
    }

    return $valid;
}

/**
 * @param string[] $values
 * @return array
 */
function getValidValues(array $values): array
{
    $invalidParts = getInvalidParts();

    return array_filter($values, function ($value) use (&$invalidParts) {
        return isValidValue($value, $invalidParts);
    });
}


$valuesSum = array_sum(getValidValues(range(1, 10000)));

print($valuesSum);
