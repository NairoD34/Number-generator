<?php

namespace number\gen\Controller;

use number\gen\App\AbstractController;

class IndexController extends AbstractController
{

    public function index()
    {
        $this->render('index.php', []);
    }
}
