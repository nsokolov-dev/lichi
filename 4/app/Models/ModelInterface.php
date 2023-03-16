<?php

namespace App\Models;

interface ModelInterface
{
    /**
     * Поместить значения полей в модель
     *
     * @param array $attributes
     * @return \App\Models\ModelInterface
     */
    public function fill(array $attributes): ModelInterface;
}
