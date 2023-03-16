<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>

<section class="page">
    <div class="page__registration">
        <h1>
            Регистрация
        </h1>
        <form method="PUT" action="/register.php" class="form _success" id="form-registration">
            <div class="form__input">
                <label>
                <span class="form__input__label">
                    Имя
                </span>
                    <input type="text" name="first_name" placeholder="Ваше имя"
                           class="form__input__text">
                </label>
            </div>
            <div class="form__input">
                <label>
                <span class="form__input__label">
                    Фамилия
                </span>
                    <input type="text" name="last_name" placeholder="Ваша фамилия"
                           class="form__input__text">
                </label>
            </div>
            <div class="form__input">
                <label>
                <span class="form__input__label">
                    E-mail
                </span>
                    <input type="email" name="email" placeholder="Ваш E-mail"
                           class="form__input__text">
                </label>
            </div>
            <div class="form__input">
                <label>
                <span class="form__input__label">
                    Введите пароль
                </span>
                    <input type="password" name="password" placeholder="********"
                           class="form__input__text">
                </label>
            </div>
            <div class="form__input">
                <label>
                <span class="form__input__label">
                    Повторите пароль
                </span>
                    <input type="password" name="password_confirmation" placeholder="********"
                           class="form__input__text">
                </label>
            </div>
            <button type="submit" class="form__button">
                Зарегистрироваться
            </button>
        </form>

        <div class="modal" id="modal-success">
            <p>Вы успешно прошли регистрацию!</p>
        </div>
    </div>
</section>

<script defer src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script defer src="/public/js/app.min.js"></script>

</body>
</html>
