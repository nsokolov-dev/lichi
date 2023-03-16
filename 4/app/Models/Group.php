<?php

namespace App\Models;

use App\Repositories\GroupRepository;
use App\Repositories\ProductRepository;

class Group extends BaseModel
{
    public int $id;
    public int $id_parent;
    public string $name;
    public ?int $products_count;

    protected GroupRepository $repository;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->repository = new GroupRepository();
    }

    /**
     * Получить дочерние группы
     *
     * @return self[]
     */
    public function childs(): array
    {
        return $this->repository->findByParent($this->id);
    }

    /**
     * Получить ссылку на страницу категории
     *
     * @return string
     */
    public function getUrl(): string
    {
        return '/?group_id=' . $this->id;
    }

    /**
     * Пересчитать количество товаров в категории
     *
     * @return void
     */
    public function recalculateProductsCount(): void
    {
        $products = (new ProductRepository())->findByGroup($this->id);
        $this->products_count = count($products);
        $this->repository->update($this->id, [
            'products_count' => $this->products_count,
        ], 'i');
    }
}
