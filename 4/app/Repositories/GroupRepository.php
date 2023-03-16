<?php

namespace App\Repositories;

use App\Models\BaseModel;
use App\Models\Group;

class GroupRepository extends BaseRepository
{
    /**
     * Получить список групп по родителю
     *
     * @param int $parent_id
     * @return \App\Models\Group[]
     */
    public function findByParent(int $parent_id = 0): array
    {
        return $this->getOrStoreCache("groups_$parent_id", function () use ($parent_id) {

            $query = 'SELECT * FROM `groups` `p` WHERE `p`.`id` IN (
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
                                      on `g2`.`id` = `cte`.`id_parent`
                        )
                        SELECT `id` FROM `cte`
                        UNION ALL
                            SELECT `g3`.`id`
                            FROM `groups` `g3`
                            WHERE `g3`.`id_parent` = ? OR `g3`.`id_parent` = 0
                    )';

            $groups = [];
            $result = $this->query($query, 'ii', $parent_id, $parent_id);
            while ($attributes = mysqli_fetch_assoc($result)) {
                $groups[] = new Group($attributes);
            }

            return $groups;
        });
    }

    /**
     * Получить все группы
     *
     * @return Group[]
     */
    public function getAll(): array
    {
        $query = 'SELECT * FROM `groups`';
        $groups = [];
        $result = $this->query($query);
        while ($attributes = mysqli_fetch_assoc($result)) {
            $groups[] = new Group($attributes);
        }

        return $groups;
    }

    public function create(array $attributes): BaseModel
    {
        // TODO: Implement create() method.
    }

    /**
     * @param int|null $id
     * @return \App\Models\BaseModel|null
     */
    public function read(?int $id): ?BaseModel
    {
        if (!$id)
            return null;

        $query = 'SELECT *
            FROM `groups`
            WHERE `id` = ?';

        $result = $this->query($query, 'i', $id);
        $attributes = mysqli_fetch_assoc($result);

        if (!$attributes)
            return null;

        return new Group($attributes);
    }

    /**
     * Обновить данные модели
     *
     * @param int $id
     * @param array $attributes
     * @param string $types
     * @return bool
     */
    public function update(int $id, array $attributes, string $types): bool
    {
        $query = 'UPDATE `groups` ' .
            'SET ' . $this->queryValues($attributes)
            . ' WHERE `id` = ?';

        $result = $this->query($query, $types . 'i', ...[...array_values($attributes), $id]);

        return $result !== false;
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }
}
