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
        if (!Security::is_connected()) {
            Dispatcher::redirect();
        }
        $projet = Model::getInstance()->getById('projet', $_GET['id_projet']);
        $taches = Model::getInstance()->getByAttribute('tache', 'id_projet', $_GET['id_projet']);
        $this->render('projet.php', ['taches' => $taches, 'projet' => $projet]);
    }

    private function isProjetNameInvalid(string $input): string|false
    {
        if (Verifier::hasHTMLShit($input)) {
            return "Nom de projet invalide";
        }
        return false;
    }

    public function updateProjet()
    {
        if (!Security::is_connected()){
            Dispatcher::redirect();
        }

        if (isset($_POST["submit"])){
            $datas = [
                "nom_projet"=> $_POST["nom_projet"],
            ];
            Model::getInstance()->updateById("projet", $_POST['id_projet'], $datas);
            Dispatcher::redirect();
        }
        else {
            $vars = [
                'form'=> ProjetForm::createForm(Dispatcher::generateUrl('projetController', 'updateProjet'),'update', $_GET["id_projet"]),
            ];
            $this->render("updateprojet.php", $vars);
        }
    }

    public function deleteProjet($id)
    {
        Model::getInstance()->supprById('projet', $id);
    }

    public function displaySupprProjet()
    {
        if (!Security::is_connected()) {
            Dispatcher::redirect();
        }
        if (isset($_GET['id_projet'])){
            $this->deleteProjet($_GET['id_projet']);
            // Dispatcher::redirect('projetController', 'displayProjets');
            Dispatcher::redirect('index.php');
        }
    }
    
}


// revoir la sécurité de modifier et supprimer pour les projets et les taches 