<?php

namespace App\Services;

class ViewRenderer
{
    /**
     * Отобразить шаблон
     *
     * @param string $view
     * @param array $data
     * @return void
     */
    public function render(string $view, array $data = []): void
    {
        extract($data);

        include 'app/Views/' . $view . '.php';
    }
}
