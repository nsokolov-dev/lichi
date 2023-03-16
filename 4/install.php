<?php

require 'bootstrap.php';

print('Добавляем поля и индексы в базу данных...' . PHP_EOL);
$migrationResult = (new \App\Services\MigrationService())
    ->migrate(file_get_contents('./create_index.sql'));
if (!$migrationResult)
    print('Ошибка миграции' . PHP_EOL);
else
    print('Успешная миграция' . PHP_EOL);


print('Пересчитываем количество товаров в группах...' . PHP_EOL);
foreach ((new \App\Repositories\GroupRepository())->getAll() as $group) {
    $group->recalculateProductsCount();
}
print('Товары успешно пересчитаны' . PHP_EOL);

print('Установка выполнена успешно' . PHP_EOL);
