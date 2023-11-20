<?php

namespace vendor\jdl\Controller;

use vendor\jdl\App\AbstractController;
use vendor\jdl\App\Model;
use vendor\jdl\Entity\Utilisateur;
use vendor\jdl\Form\CreationUtilisateurForm;
use vendor\jdl\App\Verifier;
use vendor\jdl\Form\UtilisateurForm;

class UtilisateurController extends AbstractController
{
    private function verifRegister($datas)
    {
        $datas = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'verif' => $_POST['verif'],

        ];
        $errors = [];
        if ($datas == '') {
            $errors[] = 'Un ou plusieurs champs sont vides';
        }
        if (!Verifier::validateWord($datas['username'], '_@!#0-9-') && !Verifier::validateWord($datas['password'], '_@!#0-9-')) {
            $errors[] = 'Vous utilisez des caractères interdits';
        }
        if ($_POST['password'] !== $_POST['verif']) {
            $errors[] = 'Vos mots de passe ne correspondent pas';
        }
        if (!empty(Model::getInstance()->getByAttribute('utilisateur', 'nom_utilisateur', $_POST['username']))) {
            $errors[] = "Nom d'utilisateur déjà utilisé";
        }
        if ($errors != []) {
            var_dump($errors);
            return false;
        } else {
            return true;
        }
    }

    public function displayCreateUtilisateur()
    {
        if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['verif'])) {
            $datas = [
                'nom_utilisateur' => $_POST['username'],
                'mdp' => password_hash($_POST['password'], PASSWORD_DEFAULT)

            ];
            if ($this->verifRegister($datas)) {

                $this->createUtilisateur($datas);
                $index = new IndexController();
                $index->index('Utilisateur créé');
            }
        } else {
            $vars = [
                'form' => UtilisateurForm::formSubscribe('?controller=UtilisateurController&method=displayCreateUser')
            ];
        }
        $this->render('user.php', []);
    }

    public function createUtilisateur($datas)
    {
        Model::getInstance()->save('utilisateur', $datas);
    }
    
    public function index()
    {
        // if isset submit then submitUtilisateur
        $this->render("index.php", []);
    }

    private function submitUtilisateur()
    {
    }
}
