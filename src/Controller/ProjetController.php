<?php

namespace vendor\jdl\Controller;

use vendor\jdl\App\AbstractController;
use vendor\jdl\App\Dispatcher;
use vendor\jdl\App\Security;
use vendor\jdl\App\Model;
use vendor\jdl\App\Verifier;
use vendor\jdl\Form\ProjetForm;
use vendor\jdl\Controller\TacheController;

class ProjetController extends AbstractController
{
    public function displayProjets()
    {
        if (!Security::is_connected()) { // si connecté affiche les projets 
            Dispatcher::redirect();  // redirection vers l'index si pas connecté
        }
        $results = Model::getInstance()->readAll('projet');
        $this->render('projets.php', ['projets' => $results]);
    }

    public function createProjet()
    {
        if (!Security::is_connected()) {
            Dispatcher::redirect();
        }

        if (!isset($_POST['submit'])) {
            $this->render('createprojet.php', ['form' => ProjetForm::formProjet(Dispatcher::generateUrl("ProjetController", "createProjet"))]);
            return;
        }

        // Si le nom de projet est valide
        if (($error = $this->isProjetNameInvalid($_POST['nom_projet'])) === false) {
            $datas = [
                'nom_projet' => $_POST['nom_projet'],
                'id_utilisateur' => $_SESSION['id'],
            ];
            Model::getInstance()->save('projet', $datas);
            $this->displayProjets();
            return;
        }
        $this->render('createprojet.php', ['form' => ProjetForm::formProjet(Dispatcher::generateUrl("ProjetController", "createProjet")), "error" => $error]);
    }

    public function displayProjet()
    {
        if (!Security::is_connected() || !$this->canSeeProjet($_GET['id_projet'])) {
            Dispatcher::redirect();
        }

        $projet = Model::getInstance()->getById('projet', $_GET['id_projet']);
        $taches = Model::getInstance()->getByAttribute('tache', 'id_projet', $_GET['id_projet']);
        $this->render('projet.php', ['taches' => $taches, 'projet' => $projet]);
    }

    private function canSeeProjet($id_projet)
    {
        if (!Security::does_this_exist("projet", $id_projet)) {
            return false;
        }
        if (is_null($user = Security::get_session_user())) {
            return false;
        }
        $id_user = $user->getId_utilisateur();
        $associations = Model::getInstance()->getByIds("participe", ["utilisateur" => $id_user, "projet" => $id_projet]);
        $admin = Model::getInstance()->getByIds("projet", ["utilisateur" => $id_user, "projet" => $id_projet]);
        if (empty($associations) && empty($admin)) {
            return false;
        }
        return true;
    }

    private function isProjetNameInvalid(string $input): string|false
    {
        if (Verifier::hasHTMLShit($input)) {
            return "Nom de projet invalide";
        }
        return false;
    }
}
