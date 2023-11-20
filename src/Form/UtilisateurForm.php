<?php

namespace vendor\jdl\Form;

use vendor\jdl\App\Model;

class UtilisateurForm
{
    public static function form($action)
    {
        $form = "<form action = $action method='POST'>
                <label for='titre'>Titre</label>
                <input id='titre' type='text' name='titre'>
                <label for='genre'>Genre</label>
                <input id='genre' type='text' name='genre'>
                <label for='categorie'>Categorie</label>
                <input id='categorie' type='text' name='categorie'>
                <label for='id_auteur'>Auteur</label>
                <input id='id_auteur' type='number' name='id_auteur'>
                <label for='id_editeur'>Editeur</label>
                <input id='id_editeur' type='number' name='id_editeur'>
                <button name='submit' value='submit'>submit</button>
            </form>";
        return $form;
    }
    
    public static function formUpdate($action, $livre)
    {
        $form = "<form action = $action method='POST'>
                <input id='id' name='id' value='" . $livre->getId() . "' style='display:none'>
                <label for='titre'>Titre</label>
                <input id='titre' type='text' name='titre' value ='" . $livre->getTitre() . "'>
                <label for='genre'>Genre</label>
                <input id='genre' type='text' name='genre' value ='" . $livre->getGenre() . "'>
                <label for='categorie'>Categorie</label>
                <input id='categorie' type='text' name='categorie' value ='" . $livre->getCategorie() . "'>
                <label for='id_auteur'>Auteur</label>
                <input id='id_auteur' type='number' name='id_auteur' value ='" . $livre->getIdAuteur() . "'>
                <label for='id_editeur'>Editeur</label>
                <input id='id_editeur' type='number' name='id_editeur' value ='" . $livre->getIdEditeur() . "'>
                <button name='submit' value='submit'>submit</button>
            </form>";
        return $form;
    }
}
}
