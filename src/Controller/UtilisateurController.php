<?php

namespace vendor\jdl\Controller;

use number\gen\App\AbstractController;
use number\gen\App\Dispatcher;
use number\gen\App\Security;
use number\gen\App\Model;
// use vendor\jdl\Entity\Utilisateur;
// use vendor\jdl\Form\CreationUtilisateurForm;
use number\gen\App\Verifier;
use number\gen\Form\UtilisateurForm;
use number\gen\Controller\ParticipeController;

class UtilisateurController extends AbstractController
{
    // Cette fonction sert à vérifier les datas rentré dans le form register 
    // Elle permet de savoir si le mdp et le vérif correspondent, si les champs ne sont pas vides et si le username n'existe pas déjà
    private function verifRegister()
    {
        $datas = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'verif' => $_POST['verif'],
        ];
        $errors = [];
        foreach ($datas as $key => $value) {
            if (empty($value)) {
                $errors[] = 'Votre entrée "' . $key . '" est vide';
            }
        }

        if (Security::isUserNameInvalid($datas['username']) !== false) {
            $errors[] = 'Vous utilisez des caractères interdits sur votre nom de compte';
        }
        if (Verifier::hasForbiddenChars($datas['password'], '<>"\'')) {
            $errors[] = 'Votre mot de passe ne peut pas contenir les caractères suivants : <>"\'';
        }
        if ($datas['password'] !== $datas['verif']) {
            $errors[] = 'Vos mots de passe ne correspondent pas';
        }
        if (!empty(Model::getInstance()->getByAttribute('users', 'username', $datas['username']))) {
            $errors[] = "Nom d'utilisateur déjà utilisé";
        }
        if ($errors != []) {
            $str = "<pre>";
            foreach ($errors as $error) {
                $str .= $error . "<br>";
            }
            echo $str . "</pre>";
            return false;
        } else {
            return true;
        }
    }

    // cette fonction nous permet d'afficher le formulaire d'enregistrement et de le traiter
    public function displayCreateUtilisateur()
    {
        // Si on est déjà connectéx, on redirige vers l'accueil

        if (Security::is_connected()) {
            Dispatcher::redirect();
        }


        // Si l'utilisateur a posté une inscription remplie, on la traite.
        if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['verif'])) {
            $datas = [
                'username' => $_POST['username'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)

            ];
            if ($this->verifRegister()) {
                $this->createUtilisateur($datas);
                $this->render('index.php', ["message" => 'Votre compte à bien été créé']);
                return true;
            }
        }
        $this->render('registration.php', []);
    }


    // cette function permet de traiter des datas user et des les intégrer à la BDD
    private function createUtilisateur($datas)
    {
        Model::getInstance()->save('users', $datas);
    }



    /**
     * Méthode qui détruit toutes les variables de la session en cours puis redirige sur la page d'accueil.
     */
    public function disconnect()
    {
        if (Security::is_connected()) {
            session_unset();
        }
        Dispatcher::redirect();
    }

    /**
     * Affiche le formulaire de connexion
     */
    public function displayConnectUtilisateur()
    {
        $form = UtilisateurForm::formConnect(Dispatcher::generateUrl("UtilisateurController", "displayConnectUtilisateur"));
        // Si l'utilisateur ne tente pas de se connecter, on ne traite pas le formulaire
        if (!isset($_POST['submit'])) {
            $this->render('connection.php', ["form" => $form]);
            return;
        }

        // On traite le formulaire.
        if (($error = $this->verifyConnect()) === false || Security::is_connected()) {
            Dispatcher::redirect();
        }


        $this->render('connection.php', ["form" => $form, "error" => $error]);
    }

    /**
     * Passe en revue le formulaire de connexion.
     * @return string|false : retourne un string qui contient le message d'erreur ou false s'il n'y a aucune erreur
     */
    private function verifyConnect(): string|false
    {
        if (!isset($_POST['submit'])) {
            return "Requête invalide";
        }

        if (($error = Security::isUserNameInvalid($_POST['username'])) !== false) {
            return $error;
        }

        $user = Model::getInstance()->getByAttribute('users', 'username', $_POST['username']);
        if (empty($user) || !password_verify($_POST['password'], $user[0]->getPassword())) {
            return "Identifiants non reconnus";
        }

        $_SESSION['id'] = $user[0]->getId();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['connected'] = 'connecté';
        return false;
    }

    public function displayUtilisateurs()
    {
        if (!Security::is_connected()) {
            Dispatcher::redirect();
        }
    }
}
