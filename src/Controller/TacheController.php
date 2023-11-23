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
        if (!Security::is_connected() || $this->canSeeTache($_GET['id_tache'], $_GET['id_projet']) === false) {
            Dispatcher::redirect();
        }

        $tache = Model::getInstance()->getById('tache', $_GET['id_tache']);
        if ($tache->getId_projet() != $_GET['id_projet']) {
            Dispatcher::redirect();
        }
        $priorite = Model::getInstance()->getById('priorite', $tache->getId_priorite());
        $cdv = Model::getInstance()->getCdvById('cycle_de_vie', $tache->getId_cdv());
        $user = Model::getInstance()->getById('utilisateur', $tache->getId_utilisateur());

        $this->render('tache.php', ['tache' => $tache, 'priorite' => $priorite->getLibelle(), 'cdv' => $cdv->getLibelle(), 'utilisateurs' => $user->getNom_utilisateur()]);
        var_dump($this->canSeeTache($_GET['id_tache'], $_GET['id_projet']));
    }

    public function createTache()
    {
        // Ceci n'est pas sécurisé **************************************************
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
        // Ceci n'est pas sécurisé **************************************************
        if (!Security::is_connected()) {
            Dispatcher::redirect();
        }

        if (isset($_GET['id_tache'])) {
            $this->supprTache($_GET['id_tache']);
            Dispatcher::redirect('projetController', 'displayProjet', ["id_projet" => $_GET["id_projet"]]);
        }
    }
    // ça marche pas il faut la changer
    private function canSeeTache($id_tache, $id_projet)
    {
        if (!Security::does_this_exist("tache", $id_tache)) {
            return false;
        }


        if (is_null($user = Security::get_session_user())) {
            return false;
        }
        $id_user = $user->getId_utilisateur();

        $associations = Model::getInstance()->getByIds("participe", ["utilisateur" => $id_user, "projet" => $id_projet]);
        var_dump($associations);
        $admin = Model::getInstance()->getByIds("projet", ["utilisateur" => $id_user, "projet" => $id_projet]);
        var_dump($admin);
        if (empty($associations) && empty($admin)) {
            return false;
        }
        if ($associations === null && $admin[0]->getId_utilisateur() != $_SESSION['id']) {
            return false;
        }
        return true;
    }
}
