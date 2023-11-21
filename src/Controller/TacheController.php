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

        $result = Model::getInstance()->getById('tache', $_GET['id']);
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
                'titre_tache' => $_POST['nom_projet'],
                'id_utilisateur' => $_SESSION['id'],
                'id_priorite' => $_POST['id_priorite'],
                'id_cdv' => 1,
                'id_projet' => $_GET['id_projet']
                // passer par session et pour attribuer le projet a la session qui en crée un
                // 'id_utilisateur'=> 1,   
            ];

            Model::getInstance()->save('projet', $datas);

            //$this->displayProjets(); Méthode qui existe pas ???
        } else {
            $this->render('createprojet.php', ['form' => TacheForm::formNewTache('?controller=ProjetController&method=createProjet')]);
        }
    }
}
