<?php

namespace vendor\jdl\Controller;

use vendor\jdl\App\AbstractController;
use vendor\jdl\App\Model;
use vendor\jdl\Entity\Utilisateur;
use vendor\jdl\Form\CreationUtilisateurForm;

class UtilisateurController extends AbstractController
{
  public function index()
  {
    // if isset submit then submitUtilisateur
    $this->render("index.php", []);
  }

  private function submitUtilisateur()
  {

  }
}
