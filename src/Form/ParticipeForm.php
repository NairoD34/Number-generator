<?php

namespace vendor\jdl\Form;

class ParticipeForm
{
  public static function getForm(string $action, array $options = []): string
  {
    $form = "<form action='$action' method='POST' >
      <label for='username'></label>
      <input type='text' id='username' name='username' >
      <button type='submit' name='submit'>Ajouter</button>
      <datalist>";
    foreach ($options as $value) {
      $form .= "<option value=" . $value->getNom_utilisateur() . "></option>";
    }
    $form .= "</datalist></form>";
    return $form;
  }
}
