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
        if (!Security::is_connected()) {
            Dispatcher::redirect();
        }


        if (isset($_POST['submit'])) {

            if (!empty(Model::getInstance()->getByAttribute('utilisateur', 'nom_utilisateur', $_POST['username']))) {
                $id_user = Model::getInstance()->getByAttribute('utilisateur', 'nom_utilisateur', $_POST['username'])[0];
                $datas = [
                    'id_utilisateur' => $id_user->getId_utilisateur(),
                    'id_projet' => $_GET['id_projet']

                ];

                Model::getInstance()->save('participe', $datas);

                Dispatcher::redirect('ProjetController', 'displayProjet', ['id_projet' =>  $_GET['id_projet']]);
            } else {
                $users = Model::getInstance()->readAll('utilisateur', 'nom_utilisateur');
                $error = "Nom d'utilisateur non reconnu veuillez réessayer ou le créer en cliquant sur ce bouton <a href =" . Dispatcher::generateUrl('UtilisateurController', 'createAndAddUtilisateur') . "><button>Créer l'utilisateur</button></a>";
                $this->render('addUtilisateurToProjet.php', [
                    'form' => ParticipeForm::getForm(Dispatcher::generateUrl("ParticipeController", "addUtilisateurToProjet", ['id_projet' => $_GET['id_projet']]), $users),
                    'error' => $error
                ]);
            }
        } else {
            $users = Model::getInstance()->readAll('utilisateur', 'nom_utilisateur');
            $this->render('addutilisateurtoprojet.php', [
                'form' => ParticipeForm::getForm(Dispatcher::generateUrl("ParticipeController", "addUtilisateurToProjet", ['id_projet' => $_GET['id_projet']]), $users)
            ]);
        }
    }
}
