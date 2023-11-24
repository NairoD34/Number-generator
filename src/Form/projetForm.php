<?php

namespace vendor\jdl\Form;

use vendor\jdl\App\Model;

class ProjetForm
{
    public static function createForm($action, $mode = 'create', $id_projet = 0)
    {
        if ($mode === 'update') {
            $projet = Model::getInstance()->getById('projet', $_GET['id_projet']);
            return self::formUpdateProjet($action, $projet);
        }
        return self::formProjet($action);
    }

    public static function formProjet ($action)
    {
        $form = "<form action = $action method='POST'>
                <label for = 'nom_projet'> Nom du projet </label>
                <input id='nom_projet' type='text' name='nom_projet'>
                <button name='submit' id= 'submit'> submit </button>
                </form>";
        return $form;
    }

    public static function formUpdateProjet($action, $projet)
    {
        $form = "<form action = $action method= 'POST'>
                <input id='id_projet' name='id_projet' value=' "
                . $projet->getId_projet() 
                . "' style='display:none'> 

                <label for = 'nom_projet'> Nom du projet </label>
                <input id='nom_projet' type='text' name='nom_projet' value' ".$projet->getNom_projet()."'>

                <button name='submit' value='submit'> submit </button>
                </form>";
        return $form;
    }
}

