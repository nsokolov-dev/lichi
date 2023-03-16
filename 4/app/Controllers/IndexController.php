<?php

namespace App\Controllers;

use App\Repositories\GroupRepository;
use App\Repositories\ProductRepository;
use App\Services\ObjectsArray;

class IndexController extends BaseController
{
    /**
     * Главная страница
     *
     * @return void
     */
    public function index(): void
    {
        $groupId = $_GET['group_id'] ?? null;
        $groupRepository = new GroupRepository();

        $this->view->render('IndexView', [
            'selectedGroup' => $groupRepository->read($groupId),
            'products' => (new ProductRepository())->findByGroup($groupId ?? 0),
            'groups' => (new ObjectsArray())->groupBy(
                $groupRepository->findByParent($_GET['group_id'] ?? 0),
                'id_parent'
            ),
        ]);
    }
}
