<?php

namespace vendor\jdl\Form;

use vendor\jdl\App\Model;

class UtilisateurForm
{
    public static function formSubscribe($action)
    {
        $form = "<form action = '$action' method='POST'>
                <label for='username'>Nom d'utilisateur</label>
                <input id='username' type='text' name='username'>
                <label for='password'>Votre Mot de Passe</label>
                <input id='password' type='password' name='password'>
                <label for='verif'>Vérifier votre Mot de Passe</label>
                <input id='verif' type='password' name='verif'>
                <button name='submit' value='submit'>submit</button>
            </form>";
        return $form;
    }

    public static function formConnect($action)
    {
        $form = "<form action = '$action' method='POST'>
                <input id='id' name='id' value='' style='display:none'>
                <label for='username'>Nom d'utilisateur</label>
                <input id='username' type='text' name='username' value =''>
                <label for='password'>Mot de passe</label>
                <input id='password' type='password' name='password' value =''>
                
                <button name='submit' value='submit'>Se connecter</button>
            </form>";
        return $form;
    }
}
