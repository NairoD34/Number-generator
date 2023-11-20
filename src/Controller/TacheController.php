<?php

namespace vendor\jdl\Controller;

use vendor\jdl\App\Model;
use vendor\jdl\App\AbstractController;

class TacheController extends AbstractController
{
    private function displayTaches()
    {
        $results = Model::getInstance()->readAll('tache');
        $this->render('projet.php', ['taches' => $results]);
    }
}
