<?php

namespace App\Models;

use mysqli;

abstract class BaseModel implements ModelInterface
{
    /**
     * Инициализирует поля модели, если они были переданы в конструктор
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    /**
     * Поместить значения полей в модель
     *
     * @param array $attributes
     * @return self
     */
    public function fill(array $attributes): BaseModel
    {
        foreach ($attributes as $attribute => $value) {
            $this->{$attribute} = $value;
        }
        return $this;
    }
}
