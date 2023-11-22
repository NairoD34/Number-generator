<?php
namespace vendor\jdl\App;

// Vérifie des droits utilisateurs

abstract class Security {
  public static function is_connected()
  {
      if (isset($_SESSION['username'])) {
          return true;
      }
      return false;
  }

  // public static function utilisateur_exists(string $id_utilisateur):bool
  // {
  //   if (empty(Model::getInstance()->getByAttribute('utilisateur', 'id_utilisateur', $id_utilisateur))){
  //     return false;
  //   }
  //   return true;
  // }

  public static function does_this_exist(string $entity, string $id):bool
  {
    if (empty(Model::getInstance()->getByAttribute($entity, 'id_'.$entity, $id))){
      return false;
    }
    return true;
  }
}