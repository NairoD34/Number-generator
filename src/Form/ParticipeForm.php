<?php
namespace vendor\jdl\Form;

class ParticipeForm {
  public static function getForm($action)
  {
    $form = "<form action='$action' method='POST'>
      <label for='username'></label>
      <input type='text' id='username' name='username'>
      <button type='submit' name='submit'>Ajouter</button>
    </form>";
    return $form;
  }
}

