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
        // Ceci n'est pas sécurisé ***************************************************
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
                'id_projet' => $_GET['id_projet'],

            ];

            Model::getInstance()->save('tache', $datas);

            Dispatcher::redirect('ProjetController', 'displayProjet', ['id_projet' =>  $_GET['id_projet']]);
        } else {
            $this->render('createtache.php', ['form' => TacheForm::formNewTache(Dispatcher::generateUrl("TacheController", "createTache", ["id_projet" => $_GET["id_projet"]]))]);
        }
    }
    private function supprTache($id)
    {
        Model::getInstance()->supprById('tache', $id);
    }
    public function displaySupprTache()
    {
        if (!Security::is_connected()) {
            Dispatcher::redirect();
        }

        if (isset($_GET['id_tache'])) {
            $this->supprTache($_GET['id_tache']);
            Dispatcher::redirect('projetController', 'displayProjet', ["id_projet" => $_GET["id_projet"]]);
        }
    }
}
