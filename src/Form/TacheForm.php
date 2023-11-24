<?php

namespace vendor\jdl\Form;
use vendor\jdl\App\Model;

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
            <label for = 'cdv-select'>Cycle de vie</label>
            <select name='cdv' id='cdv-select'>";
        $cycles = ["-" => "-- Choisissez un cycle de vie --", "1" => "Non débuté", "2" =>"En cours", "3" =>"Terminé" ];
        foreach ($cycles as $key=>$cycle) {
            $form .= "<option value='$key'>$cycle</option>";
        }
        $form .= "</select><button type='submit' name='submit' id='submit'>Envoyer</button>
            </form>";
        return $form;
    }

    public static function formNewTache($action)
    {
        return self::getForm($action);
    }

    public static function formUpdateTache(string $action, object $tache, ?string $priorite="", ?string $cdv="")
    {
        // return self::getForm($action, $titre_tache, $description, $priorite);
        $form = "<form action = $action method='POST' >
            <input id='id_tache' name='id_tache' value=' " . $tache->getId_tache() . "' style='display:none'>

            <label for = 'titre_tache'> Titre de votre tâche </label>
            <input id='titre_tache' type='text' name='titre_tache' value='". $tache->getTitre_tache()."'>
            <label for = 'description'> Description de votre tâche </label>
            <input id='description' type='text' name='description' value='" .$tache->getDescription(). "'>
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

        <label for = 'cdv-select'>Cycle de vie</label>
            <select name='cdv' id='cdv-select'>";
            $cycles = ["-" => "-- Choisissez un cycle de vie --", "1" => "Non débuté", "2" =>"En cours", "3" =>"Terminé" ];
        foreach ($cycles as $key=>$cycle) {
            $form .= "<option value='$key'";
            if ($cdv == $key) {
                $form .= " selected";
            }
            $form .= ">$cycle</option>";
        }

        $form .= "</select>
            <button name='submit' id= 'submit'> submit </button>
        </form>";
        return $form;
    }


    public static function createForm($action, $mode = 'create', $id_tache = 0)
    {
        if ($mode === 'update') {
            $tache = Model::getInstance()->getById('tache', $_GET['id_tache']);
            return self::formUpdateTache($action, $tache);
        }
        return self::formNewTache($action);
    }

    public static function getFormTache(string $action, array $options = [])
    {
        $form = "<form action='$action' method='POST' >
            <label for='username'></label>
            <input list='usersList' id='username' name='username' >
            <datalist id='usersList'>";
        foreach ($options as $value) {
          $form .= "<option value=" . $value->getNom_utilisateur() . "></option>";
        }
        $form .= "</datalist><button type='submit' name='submit'>Ajouter</button></form>";
        return $form;
    }
}

