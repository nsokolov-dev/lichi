<?php

namespace App\Repositories;

use App\Models\BaseModel;
use App\Models\Product;

class ProductRepository extends BaseRepository
{
    /**
     * Получить все товары
     *
     * @return Product[]
     */
    public function getAll(): array
    {
        $query = 'SELECT * FROM `products`';
        $result = $this->query($query);

        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = new Product($row);
        }

        return $products;
    }

    /**
     * Получить товары из категории
     *
     * @param int $group_id
     * @return Product[]
     */
    public function findByGroup(int $group_id): array
    {
        if ($group_id == 0) {
            return $this->getAll();
        }

        $query = 'SELECT * FROM `products` `p` WHERE `p`.`id_group` IN (
                        WITH RECURSIVE cte (id, id_parent) AS
                        (
                          SELECT `g1`.`id`, 
                                 `g1`.`id_parent`
                          FROM `groups` `g1`
                          WHERE `g1`.`id` = ?
                          UNION ALL
                              SELECT `g2`.`id`,
                                     `g2`.`id_parent`
                              FROM `groups` `g2`
                              inner join `cte`
                                      on `g2`.`id_parent` = `cte`.`id`
                        )
                        SELECT `id` FROM `cte`
                    )';
        $result = $this->query($query, 'i', $group_id);

        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = new Product($row);
        }

        return $products;
    }

    public function create(array $attributes): BaseModel
    {
        // TODO: Implement create() method.
    }

    public function read(int $id): BaseModel
    {
        // TODO: Implement read() method.
    }

    public function update(int $id, array $attributes, string $types): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }
}
