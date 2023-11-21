<?php

namespace vendor\jdl\Controller;

use vendor\jdl\App\AbstractController;
use vendor\jdl\App\Dispatcher;
use vendor\jdl\App\Security;
use vendor\jdl\App\Model;
use vendor\jdl\Form\ProjetForm;
use vendor\jdl\Controller\TacheController;

class ProjetController extends AbstractController
{
    public function displayProjets()
    {
        if (!Security::is_connected()) {
            Dispatcher::redirect();
        }
        $results = Model::getInstance()->readAll('projet');
        $this->render('projets.php', ['projets' => $results]);
    }

    public function createProjet()
    {
        if (!Security::is_connected()) {
            Dispatcher::redirect();
        }

        if (isset($_POST['submit'])) {
            $datas = [
                'nom_projet' => $_POST['nom_projet'],
                'id_utilisateur' => $_SESSION['id'],
                // passer par session et pour attribuer le projet a la session qui en crée un
                // 'id_utilisateur'=> 1,   
            ];

            Model::getInstance()->save('projet', $datas);

            $this->displayProjets();
        } else {
            $this->render('createprojet.php', ['form' => ProjetForm::formProjet('?controller=ProjetController&method=createProjet')]);
        }
    }

    public function displayProjet()
    {
        if (!Security::is_connected()) {
            Dispatcher::redirect();
        }
        $result = Model::getInstance()->getById('projet', $_GET['id']);
        $results = Model::getInstance()->getByAttribute('tache', 'id_projet', $_GET['id_projet']);
        $this->render('projet.php', ['taches' => $results, 'projet' => $result]);
    }
}
