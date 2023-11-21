<?php

namespace vendor\jdl\Controller;

use vendor\jdl\App\AbstractController;
// efface-moi ***********
use vendor\jdl\App\Security;
// **********************

//use vendor\jdl\App\Model;

class IndexController extends AbstractController
{

    public function index()
    {
        var_dump(Security::hasHTMLShit("hello world"));
        $this->render('index.php', []);

    }
}
