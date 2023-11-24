<?php

namespace vendor\jdl\Controller;

use vendor\jdl\App\Model;
use vendor\jdl\App\AbstractController;
use vendor\jdl\App\Dispatcher;
use vendor\jdl\App\Security;
use vendor\jdl\App\Verifier;
use vendor\jdl\Form\TacheForm;

class TacheController extends AbstractController
{
    public function displayTache()
    {
        // Ceci n'est pas sécurisé ***************************************************
        if (!Security::is_connected() || $this->canSeeTache($_GET['id_tache'], $_GET['id_projet']) === false) {
            Dispatcher::redirect();
        }

        $tache = Model::getInstance()->getById('tache', $_GET['id_tache']);
        if ($tache->getId_projet() != $_GET['id_projet']) {
            Dispatcher::redirect();
        }
        $priorite = Model::getInstance()->getById('priorite', $tache->getId_priorite());
        $cdv = Model::getInstance()->getCdvById('cycle_de_vie', $tache->getId_cdv());
        $user = Model::getInstance()->getById('utilisateur', $tache->getId_utilisateur());

        $this->render('tache.php', ['tache' => $tache, 'priorite' => $priorite->getLibelle(), 'cdv' => $cdv->getLibelle(), 'utilisateurs' => $user->getNom_utilisateur()]);
    }

    /**
     * si pas connecté => redirection vers l'index
     * sinon création d'une tache en vérifiant les entrées dans le formulaire
     * 
     */
    public function createTache()
    {
        // Ceci n'est pas sécurisé **************************************************
        if (!Security::is_connected()) {
            Dispatcher::redirect();
        }

        if (isset($_POST['submit']) && !($error = $this->validatePostTacheForm())) {
            $datas = [
                'titre_tache' => $_POST['titre_tache'],
                'description' => $_POST['description'],
                'id_utilisateur' => $_SESSION['id'],
                'id_priorite' => $_POST['priorite'],
                'id_cdv' => $_POST['cdv'],
                'id_projet' => $_GET['id_projet'],
            ];

            Model::getInstance()->save('tache', $datas);

            Dispatcher::redirect('ProjetController', 'displayProjet', ['id_projet' => $_GET['id_projet']]);
        } else {
            $this->render('createtache.php', [
                'form' => TacheForm::formNewTache(Dispatcher::generateUrl("TacheController", "createTache", ["id_projet" => $_GET["id_projet"]])),
                'error' => empty($error) ? null : $error,
            ]);
        }
    }

    /**
     * supprime la tache en récupérant l'id 
     */
    
    private function supprTache($id)
    {
        Model::getInstance()->supprById('tache', $id);
    }

    public function displaySupprTache()
    {
        if (!Security::is_connected() || 
            !isset($_GET['id_tache']) ||
            !Security::does_this_exist("tache", isset($_GET['id_tache']))
        ) {
            Dispatcher::redirect();
        }

        $projetId = Model::getInstance()->getById( "tache", $_GET['id_tache'])->getId_projet();
        if (!Security::isAdmin(Security::get_session_user()->getId_utilisateur(), $projetId)) {
            Dispatcher::redirect();
        }
        
        $this->supprTache($_GET['id_tache']);
        Dispatcher::redirect('projetController', 'displayProjet', ["id_projet" => $_GET["id_projet"]]);
    }

    /**
     * Modifie la tache si est connecté et que la tache existe avec l'id => 
     * la tache est modifié en mettant par defaut ses attributs.
     */
    public function updateTache()
    {
        if (Security::does_this_exist("tache", $_GET['id_tache'])) {
            $tache = Model::getInstance()->getById("tache", $_GET['id_tache']);
        }
        if (!Security::is_connected() || !$this->canSeeTache($tache->getId_tache(), $tache->getId_projet())) {
            Dispatcher::redirect();
        }

        if (isset($_POST['submit']) && !($error = $this->validatePostTacheForm())){
            $datas = [
                'titre_tache' => $_POST['titre_tache'],
                'description' => $_POST['description'],
                'id_utilisateur' => $_SESSION['id'],
                'id_priorite' => $_POST['priorite'],
                'id_cdv' => $_POST['cdv'],
            ];

            Model::getInstance()->updateById('tache', $tache->getId_tache(), $datas);
            Dispatcher::redirect("ProjetController", "displayProjet", ["id_projet" => $tache->getId_projet()]);
        }
        else {
            $vars = [
                'form' => TacheForm::createForm(Dispatcher::generateUrl('TacheController','updateTache', ["id_tache" => $_GET['id_tache']]), 'update', $_GET['id_tache']),
                'error' => empty($error) ? null : $error,
            ];
            $this->render('taches.php', $vars);
        }

    }

    private function canSeeTache($id_tache, $id_projet)
    {
        if (!Security::does_this_exist("tache", $id_tache)) {
            return false;
        }

        if (is_null($user = Security::get_session_user())) {
            return false;
        }
        $id_user = $user->getId_utilisateur();

        $associations = Model::getInstance()->getByIds("participe", ["utilisateur" => $id_user, "projet" => $id_projet]);
        $admin = Model::getInstance()->getByIds("projet", ["utilisateur" => $id_user, "projet" => $id_projet]);
        if (empty($associations) && !Security::isAdmin($id_user, $id_projet)) {
            return false;
        }
        if ($associations === null && $admin[0]->getId_utilisateur() != $_SESSION['id']) {
            return false;
        }
        return true;
    }

    /**
     * Retourne une erreur si y'a un problème, autrement retourne false si y'en a pas
     **/ 
    private function validatePostTacheForm():string|false 
    {
        if (Verifier::hasHTMLShit($_POST['titre_tache']) || !Verifier::validateWord($_POST['titre_tache'], " &_',-")) {
            return "Titre de tâche invalide (caractères interdits)";
        }
        if (Verifier::hasHTMLShit($_POST['description']) || !Verifier::validateWord($_POST['description'], " &_',-")) {
            return "Description de tâche invalide (caractères interdits)";
        }
        if (Verifier::hasHTMLShit($_POST['priorite']) || !Verifier::isNumber($_POST['priorite'])) {
            return "Valeur de priorité invalide (caractères interdits)";
        }
        if (Verifier::hasHTMLShit($_POST['cdv']) || !Verifier::isNumber($_POST['cdv'])) {
            return "Valeur de cycle de vie invalide (caractères interdits)";
        }
        return false;
    }

    public function updateUtilisateurToTache()
    {
        if (!Security::is_connected()){
            Dispatcher::redirect();
        }

        if (isset($_POST['submit'])){

            if (!empty(Model::getInstance()->getByAttribute('utilisateur', 'nom_utilisateur', $_POST['username']))) {
                $id_users = Model::getInstance()->getByAttribute('utilisateur', 'nom_utilisateur', $_POST['username'])[0];
                if (!empty(Model::getInstance()->getUtilisateurByProjet($id_users->getId_utilisateur()))){
                    $user = Model::getInstance()->readAll('utilisateur', 'nom_utilisateur');
                    $error = "Cet utilisateur est déjà attribué à votre tâche !";
                    $this->render('updateutilisateurtotache.php', [
                        'form'=> TacheForm::getFormTache(Dispatcher::generateUrl('TacheController', 'updateUtilisateurToTache', ['id_projet' => $_GET['id_projet'], 'id_tache' => $_GET['id_tache']]), $user),
                        'error'=> $error
                    ]);
                } else {
                    $data = [
                        'id_utilisateur'=> $id_users->getId_utilisateur(),
                        'id_tache' => $_GET['id_tache']
                    ];

                    Model::getInstance()->updateById('tache', $_GET['id_tache'], $data);

                    Dispatcher::redirect('ProjetController', 'displayProjet', [
                        'id_projet'=> $_GET['id_projet'],
                        // 'id_tache' => $_GET['id_tache']
                    ]);
                }
            } else {
                // echo 'coucou';
                $user = Model::getInstance()->readAll('utilisateur','nom_utilisateur');
                $error = "Cet utilisateur ne participe pas à votre projet veuillez le rajouter en cliquant ici <a href =" . Dispatcher::generateUrl('ParticipeController', 'addUtilisateurToProjet', ['id_projet' => $_GET['id_projet'], 'id_tache' => $_GET['id_tache']]) . "><button>Ajouter votre participant</button></a>";
                $this->render('updateutilisateurtotache.php' , [
                    'form'=> TacheForm::getFormTache(Dispatcher::generateUrl('TacheController', 'updateUtilisateurToTache' , ['id_projet' => $_GET['id_projet'], 'id_tache'=> $_GET['id_tache']]), $user),
                    'error'=> $error
                ]);
            }
        } else {
            $users = Model::getInstance()->readAll('utilisateur', 'nom_utilisateur');
            $this->render('updateutilisateurtotache.php', [
                'form' => TacheForm::getFormTache(Dispatcher::generateUrl("TacheController", "updateUtilisateurToTache", ['id_projet' => $_GET['id_projet'], 'id_tache' => $_GET['id_tache']]), $users)
            ]);
        }
    }
}
