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
            $datas = [
                'nom_utilisateur' => $_POST['username'],

            ];

            Model::getInstance()->save('participe', $datas);

            Dispatcher::redirect('TacheController', 'displayTache', ['id_tache' =>  $_GET['id_tache']]);
        } else {
            $user = Model::getInstance()->getByAttribute('utilisateur', 'nom_utilisateur', '');
            $this->render('addutilisateurtoprojet.php', ['form' => ParticipeForm::getForm(Dispatcher::generateUrl("ParticipeController", "addUtilisateurToProjet"))]);
        }
    }
}
