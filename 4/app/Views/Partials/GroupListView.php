<?php
/**
 * @var \App\Models\Group[] $groups
 * @var \App\Models\Group $selectedGroup
 * @var \App\Models\Group[] $currentLevel
 */
?>

<ul>
    <?php foreach ($currentLevel as $group): ?>
        <li>
            <a href="<?= $group->getUrl() ?>"
               class="<?= (isset($groups[$group->id]) || ($selectedGroup && $group->id == $selectedGroup->id)) ? '_open' : '' ?>">
                <?= $group->name ?>
            </a>
            <span>
                <?= $group->products_count ?>
            </span>
            <?php if (isset($groups[$group->id])) {
                $this->render('Partials/GroupListView', [
                    'groups' => $groups,
                    'selectedGroup' => $selectedGroup,
                    'currentLevel' => $groups[$group->id],
                ]);
            } ?>
        </li>
    <?php endforeach; ?>
</ul>
