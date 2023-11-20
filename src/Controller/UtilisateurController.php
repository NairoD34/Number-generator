<?php

namespace vendor\jdl\Controller;

use vendor\jdl\App\AbstractController;
use vendor\jdl\App\Model;
use vendor\jdl\Entity\Utilisateur;
use vendor\jdl\Form\CreationUtilisateurForm;

class UtilisateurController extends AbstractController
{
    public function createUtilisateur($data)
    {
        Model::getInstance()->save('utilisateur', $data);
    }
}
