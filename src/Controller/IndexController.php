<?php

namespace vendor\jdl\Controller;

use vendor\jdl\App\AbstractController;

class IndexController extends AbstractController
{

    public function index()
    {
        $this->render('index.php', []);
    }
}
