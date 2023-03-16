# Пятая часть тестового задания

## Установка и запуск

1. Выполните установку зависимостей composer (composer используется только для генерации файла автозагрузки)

   ``` 
   composer install 
   ```

2. Запустите локальный сервер, точка входа - `index.php`

---

### Список уже существующих пользователей

Пользователи извлекаются из репозитория `App/Repositories/UserRepository`

``` 
[
   ['id' => 1, 'email' => 'johndoe@gmail.com', 'first_name' => 'John'],
   ['id' => 2, 'email' => 'anna@yandex.ru', 'first_name' => 'Anna'],
]
```
