<?php

namespace vendor\jdl\Form;

class ParticipeForm
{
  public static function getForm(string $action, array $options = []): string
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
