<?php

namespace vendor\jdl\Form;

use vendor\jdl\App\Model;

class TacheForm
{
    public static function createForm($action, $mode = 'create', $id = 0)
    {
        if ($mode === 'update') {
            $projet = Model::getInstance()->getById('projet', $id);
            return self::formUpdateTache($action, $projet);
        }
        return self::formNewTache($action);
    }

    public static function formNewTache($action)
    {
        $form = "<form action = $action method='POST'>
                <label for = 'titre_tache'> Titre de votre tâche </label>
                <input id='titre_tache' type='text' name='titre_tache'>
                <label for = 'description'> Description de votre tâche </label>
                <input id='description' type='text' name='description'>
                <label for = 'priorite-select'>Niveau d'urgence</label>
                <select name='priorite' id='priorite-select'>
                <option value =''> -- Choisissez un niveau d'urgence --</option>
                <option value = '1'>ROUGE</option>
                <option value = '2'>ORANGE</option>
                <option value = '3'>JAUNE</option>
                <option value = '4'>VERT</option>
                </select>
                <button name='submit' id= 'submit'> submit </button>
                </form>";
        // $this->render('projet.php', ['form'=> $form]);
        return $form;
    }

    public static function formUpdateTache($action, $projet)
    {
        $form = "<form action = $action method= 'POST'>
                <p>TEST</p>
                <button name='submit' value='submit'> submit </button>
                </form>";
        return $form;
    }
}
