<?php

namespace vendor\jdl\App;

// Vérifie des droits utilisateurs

abstract class Security
{
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

  public static function does_this_exist(string $entity, string $id): bool
  {
    if (empty(Model::getInstance()->getByAttribute($entity, 'id_' . $entity, $id))) {
      return false;
    }
    return true;
  }

  public static function does_this_exist_and(string $entity1, $id1, $entity2, $id2)
  {
    if (empty(Model::getInstance()->getByAttribute($entity1, 'id_' . $entity1, $id1)) && empty(Model::getInstance()->getByAttribute($entity1, 'id_' . $entity2, $id2))) {
      return false;
    }
    return true;
  }

  public static function get_session_user(): object|null
  {
    if (!self::is_connected()) {
      return null;
    }
    if (empty($user = Model::getInstance()->getByAttribute("utilisateur", "nom_utilisateur", $_SESSION['username'])[0])) {
      return null;
    }
    return $user;
  }
}
