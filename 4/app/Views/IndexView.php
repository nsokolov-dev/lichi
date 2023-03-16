<?php
/**
 * @var \App\Models\Group $selectedGroup
 * @var \App\Models\Group[] $groups
 * @var \App\Models\Product[] $products
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Каталог</title>
    <style>
        .container {
            display: flex;
        }
        ._open {
            color: green;
        }
    </style>
</head>
<body>

<div class="container">
    <ul>
        <li>
            <a href="/">Все товары</a>
            <?php
            $this->render('Partials/GroupListView', [
                'selectedGroup' => $selectedGroup,
                'currentLevel' => $groups[0],
                'groups' => $groups,
            ]);
            ?>
        </li>
    </ul>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <?= $product->name ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>
