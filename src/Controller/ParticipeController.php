<?php

namespace vendor\jdl\Controller;

use vendor\jdl\App\AbstractController;
use vendor\jdl\Form\ParticipeForm;
use vendor\jdl\App\Security;
use vendor\jdl\App\Dispatcher;
use vendor\jdl\App\Model;


class ParticipeController extends AbstractController
{
    public function addUtilisateurToProjet()
    {
        // Si je suis pas co, ou que le projet n'est pas set, ou qu'il n'existe pas...
        if (!Security::is_connected() || !isset($_GET['id_projet']) || !Security::does_this_exist("projet", $_GET['id_projet'])) {
            Dispatcher::redirect();
        }

        // Si on a pas répondu au formulaire ou que le nom entré est invalide...
        if (!isset($_POST['submit']) || $error = Security::isUserNameInvalid($_POST['username'])) {
        } 
        // Si il n'y a personne qui répond au nom entré...
        elseif (empty($userAdded = Model::getInstance()->getByAttribute('utilisateur', 'nom_utilisateur', $_POST['username'])) || !$userAdded = $userAdded[0]) { 
            $error = "Nom d'utilisateur non reconnu veuillez réessayer ou le créer en cliquant sur ce bouton <a href =" . Dispatcher::generateUrl('UtilisateurController', 'displayCreateUtilisateurAndAddToProjet', ['id_projet' => $_GET['id_projet']]) . "><button>Créer l'utilisateur</button></a>";
        } 
        // Si l'utilisateur est déjà affecté au projet ...
        elseif (!empty(Model::getInstance()->getProjetsByIdUtilisateur($userAdded->getId_utilisateur(), $_GET['id_projet']))) {
            var_dump($userAdded);
            $error = "Cet utilisateur participe déjà à votre projet";
        } else {
            $datas = [
                'id_utilisateur' => $userAdded->getId_utilisateur(),
                'id_projet' => $_GET['id_projet']
            ];

            Model::getInstance()->save('participe', $datas);
            Dispatcher::redirect('ProjetController', 'displayProjet', ['id_projet' =>  $_GET['id_projet']]);
        }

        $users = Model::getInstance()->readAll('utilisateur', 'nom_utilisateur');
        $this->render('addutilisateurtoprojet.php', [
            'form' => ParticipeForm::getForm(Dispatcher::generateUrl("ParticipeController", "addUtilisateurToProjet", ['id_projet' => $_GET['id_projet']]), $users),
            'error' => empty($error) ? "" : $error,
        ]);
    }
}