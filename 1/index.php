<?php

$inputRows = [
    [399, 9160, 144, 3230, 407, 8875, 1597, 9835],
    [2093, 3279, 21, 9038, 918, 9238, 2592, 7467],
    [3531, 1597, 3225, 153, 9970, 2937, 8, 807],
    [7010, 662, 6005, 4181, 3, 4606, 5, 3980],
    [6367, 2098, 89, 13, 337, 9196, 9950, 5424],
    [7204, 9393, 7149, 8, 89, 6765, 8579, 55],
    [1597, 4360, 8625, 34, 4409, 8034, 2584, 2],
    [920, 3172, 2400, 2326, 3413, 4756, 6453, 8],
    [4914, 21, 4923, 4012, 7960, 2254, 4448, 1]
];

/**
 * Получить последовательность фибоначи в пределах 0,...,$maxValue
 *
 * @param int $maxValue
 * @return int[]
 */
function getFibonacciSequence(int $maxValue): array
{
    $row = [1];
    $currentIndex = 0;

    while (true) {
        $nextValue = $row[$currentIndex] + ($row[$currentIndex - 1] ?? 0);

        if ($nextValue > $maxValue) {
            break;
        }

        $row[] = $nextValue;
        $currentIndex++;
    }

    return $row;
}

/**
 * Получить максимальное число из переданных
 *
 * @param array[] $rows
 * @return int
 */
function getRowsMaxValue(array $rows): int
{
    return max(array_map(function ($row) {
        return max($row);
    }, $rows));
}

/**
 * Получить элементы массива, которые входят в последовательность Фибоначчи
 *
 * @param int[] $values
 * @param int[] $fibonacciSequence
 * @return int[]
 */
function filterFibonacciValues(array $values, array $fibonacciSequence): array
{
    return array_filter($values, function ($value) use ($fibonacciSequence) {
        return in_array($value, $fibonacciSequence);
    });
}

/**
 * Получить сумму чисел, которые входят в последовательность Фибоначчи
 *
 * @param int[] $values
 * @param int[] $fibonacciSequence
 * @return int
 */
function getFibonacciValuesSum(array $values, array $fibonacciSequence): int
{
    return array_sum(filterFibonacciValues($values, $fibonacciSequence));
}

$maxValue = getRowsMaxValue($inputRows);
$fibonacciSequence = getFibonacciSequence($maxValue);

$fibonacciTotalSum = array_sum(array_map(function ($row) use ($fibonacciSequence) {
    return getFibonacciValuesSum($row, $fibonacciSequence);
}, $inputRows));

print($fibonacciTotalSum);
