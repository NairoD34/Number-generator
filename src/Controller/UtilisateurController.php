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
    // Cette fonction sert à vérifier les datas rentré dans le form register 
    // Elle permet de savoir si le mdp et le vérif correspondent, si les champs ne sont pas vides et si le username n'existe pas déjà
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
            $str = "<pre>";
            foreach($errors as $error) {
                $str .= $error."<br>";
            }
            echo $str."</pre>";
            return false;
        } else {
            return true;
        }
    }


    // cette fonction nous permet d'afficher le formulaire d'enregistrement et de le traiter

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
                $index->index();
                echo 'Votre compte à bien été créé';
                return true;
            }
        }
        $this->render('registration.php', []);
    }

    // cette function permet de traiter des datas user et des les intégrer à la BDD
    public function createUtilisateur($datas)
    {
        Model::getInstance()->save('utilisateur', $datas);
    }



    private function displayconnectUtilisateur()
    {
    }
}
