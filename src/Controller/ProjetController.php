<?php

namespace vendor\jdl\Controller;

use vendor\jdl\App\AbstractController;
use vendor\jdl\App\Model;
use vendor\jdl\Form\ProjetForm;

class ProjetController extends AbstractController
{
    public function displayProjets()
    {
        // echo 'coucou';
        // pas connecté -> redirect index
        $result = Model::getInstance()->readAll('projet');
        $this->render('projets.php', ['projets'=> $result]);
    }

    public function createProjet()
    {
        if (isset($_POST['submit'])) {
            $datas = [
                'nom_projet' => $_POST['nom_projet'],
                $_SESSION,
                // passer par session et pour attribuer le projet a la session qui en crée un
                'id_utilisateur'=> 1,   

            ];

            Model::getInstance()->save('projet' , $datas);

            $this->displayProjets();
        } else {
            $this->render('projet.php', ['form' => ProjetForm::formProjet('?controller=ProjetController&method=createProjet')]);
        }
    }
}