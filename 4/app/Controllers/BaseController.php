<?php

namespace App\Controllers;

use App\Services\ViewRenderer;

abstract class BaseController
{
    protected ViewRenderer $view;

    public function __construct()
    {
        $this->view = new ViewRenderer();
    }
}
