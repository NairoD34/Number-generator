<?php

namespace vendor\jdl\Controller;

use vendor\jdl\App\Model;
use vendor\jdl\App\AbstractController;
use vendor\jdl\App\Dispatcher;
use vendor\jdl\App\Security;
use vendor\jdl\Form\TacheForm;

class TacheController extends AbstractController
{
    public function displayTache()
    {
        if (!Security::is_connected()) {
            Dispatcher::redirect();
        }

        $result = Model::getInstance()->getById('tache', $_GET['id_tache']);
        $user = Model::getInstance()->getByAttribute('utilisateur', 'id_utilisateur', $_GET['id_utilisateur']);
        $priorite = Model::getInstance()->getByAttribute('priorite', 'id_priorite', $_GET['id_priorite']);
        $cdv = Model::getInstance()->getByAttribute('cycle_de_vie', 'id_cdv', $_GET['id_cdv']);
        $this->render('tache.php', ['utilisateurs' => $user, 'tache' => $result, 'priorite' => $priorite, 'cdv' => $cdv]);
    }
    public function createTache()
    {
        if (!Security::is_connected()) {
            Dispatcher::redirect();
        }

        if (isset($_POST['submit'])) {
            $datas = [
                'titre_tache' => $_POST['titre_tache'],
                'description' => $_POST['description'],
                'id_utilisateur' => $_SESSION['id'],
                'id_priorite' => $_POST['priorite'],
                'id_cdv' => 1,
                'id_projet' => $_GET['id'],

            ];

            Model::getInstance()->save('tache', $datas);

            Dispatcher::redirect('ProjetController', 'displayProjet', ['id' =>  $_GET['id']]);
        } else {
            $this->render('createtache.php', ['form' => TacheForm::formNewTache('?controller=TacheController&method=createTache')]);
        }
    }
}
