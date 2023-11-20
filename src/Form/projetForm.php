<?php

namespace vendor\jdl\Form;

use vendor\jdl\App\Model;

class ProjetForm
{
    public static function createForm($action, $mode = 'create', $id = 0)
    {
        if ($mode === 'update') {
            $projet = Model::getInstance()->getById('projet', $id);
            return self::formUpdate($action, $projet);
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
        // $this->render('projet.php', ['form'=> $form]);
        return $form;
    }

    public static function formUpdate($action, $projet)
    {
        $form = "<form action = $action method= 'POST'>
                <p>TEST</p>
                <button name='submit' value='submit'> submit </button>
                </form>";
        return $form;
    }
}