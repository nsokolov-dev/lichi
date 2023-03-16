<?php

namespace App\Services;

class ObjectsArray
{
    /**
     * Функция группирует элементы массива по ключу
     *
     * @param array $nodes
     * @param string $by
     * @return array
     */
    public function groupBy(array $nodes, string $by): array
    {
        $groups = [];

        foreach ($nodes as $node) {
            if (!isset($groups[$node->{$by}]))
                $groups[$node->{$by}] = [];

            $groups[$node->{$by}][] = $node;
        }

        return $groups;
    }
}
