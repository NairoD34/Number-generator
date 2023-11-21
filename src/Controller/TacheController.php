<?php

namespace vendor\jdl\Controller;

use vendor\jdl\App\Model;
use vendor\jdl\App\AbstractController;
use vendor\jdl\App\Dispatcher;

class TacheController extends AbstractController
{
    public function displayTache()
    {
        if (!Dispatcher::is_connected()) {
            Dispatcher::redirect();
        }

        $result = Model::getInstance()->getById('tache', $_GET['id']);
        $user = Model::getInstance()->getByAttribute('utilisateur', 'id_utilisateur', $_GET['id_utilisateur']);
        $priorite = Model::getInstance()->getByAttribute('priorite', 'id_priorite', $_GET['id_priorite']);
        $cdv = Model::getInstance()->getByAttribute('cycle_de_vie', 'id_cdv', $_GET['id_cdv']);
        $this->render('tache.php', ['utilisateurs' => $user, 'tache' => $result, 'priorite' => $priorite, 'cdv' => $cdv]);
    }
}
