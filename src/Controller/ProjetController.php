<?php

namespace vendor\jdl\Controller;

use vendor\jdl\App\AbstractController;
use vendor\jdl\App\Dispatcher;
use vendor\jdl\App\Model;
use vendor\jdl\Form\ProjetForm;

class ProjetController extends AbstractController
{
    public function displayProjets()
    {
        // echo 'coucou';
        if ( Dispatcher::is_connected() ){
            $result = Model::getInstance()->readAll('projet');
            $this->render('projets.php', ['projets'=> $result]);
        }
        else {
            Dispatcher::redirect();
        }
        // pas connecté -> redirect index
    }

    public function createProjet()
    {
        if (isset($_POST['submit'])) {
            $datas = [
                'nom_projet' => $_POST['nom_projet'],
                'id_utilisateur'=> $_SESSION['id'],
                // passer par session et pour attribuer le projet a la session qui en crée un
                // 'id_utilisateur'=> 1,   

            ];

            Model::getInstance()->save('projet' , $datas);

            $this->displayProjets();
        } else {
            $this->render('createprojet.php', ['form' => ProjetForm::formProjet('?controller=ProjetController&method=createProjet')]);
        }
    }
}