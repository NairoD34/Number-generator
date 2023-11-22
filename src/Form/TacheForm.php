<?php

namespace vendor\jdl\Form;

use vendor\jdl\App\Model;

// TEST THIS

class TacheForm
{

    private static function getForm(string $action, 
        string $titre_tache="",
        string $description="",
        string $priorite="" )
    {
        $form = "<form action = $action method='POST'
            <label for = 'titre_tache'> Titre de votre tâche </label>
            <input id='titre_tache' type='text' name='titre_tache' value='$titre_tache'>
            <label for = 'description'> Description de votre tâche </label>
            <input id='description' type='text' name='description' value='$description'>
            <label for = 'priorite-select'>Niveau d'urgence</label>
            <select name='priorite' id='priorite-select'>";
        $options = ["-" => "-- Choisissez un niveau d'urgence --", "1" => "ROUGE", "2" =>"ORANGE", "3" =>"JAUNE", "4" =>"VERT"];
        foreach ($options as $key=>$option) {
            $form .= "<option value='$key'";
            if ($priorite === $key) {
                $form .= " selected";
            }
            $form .= ">$option</option>";
        }

        $form .= "</select>
            <button name='submit' id= 'submit'> submit </button>
            </form>";
        return $form;
    }

    public static function formNewTache($action)
    {
        return self::getForm($action);
    }

    public static function formUpdateTache(string $action, 
        string $titre_tache="",
        string $description="",
        string $priorite="")
    {
        return self::getForm($action, $titre_tache, $description, $priorite);
    }
}
