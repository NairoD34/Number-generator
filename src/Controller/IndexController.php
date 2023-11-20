<?php

namespace vendor\jdl\Controller;

use vendor\jdl\App\AbstractController;
//use vendor\jdl\App\Model;

class IndexController extends AbstractController
{

    public function index()
    {
        $this->render('index.php', []);
    }
}
