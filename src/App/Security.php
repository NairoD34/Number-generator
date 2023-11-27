<?php

namespace number\gen\App;

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
  // SELECT * FROM $entity WHERE id_entity = x AND id_entity2 = y

  public static function does_this_exist(string $entity, string $id): bool
  {
    if (empty(Model::getInstance()->getByAttribute($entity, 'id_' . $entity, $id))) {
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

  /**
   * Vérifie sur l'user est admin d'un projet donné
   */
  public static function isAdmin($id_user, $id_projet)
  {
    if (empty(Model::getInstance()->getByIds("projet", ["utilisateur" => $id_user, "projet" => $id_projet]))) {
      return false;
    }
    return true;
  }

  /**
   * Renvoie une string d'erreur si le nom est invalide. Sinon, renvoie false.
   */
  public static function isUserNameInvalid(string $name): string|false
  {
    if ($name === "") {
      return "Entrée de nom d'utilisateur invalide : champ vide";
    }
    if (Verifier::hasHTMLShit($name) || !Verifier::validateWord($name, '_@!#0-9-')) {
      return "Entrée de nom d'utilisateur invalide : caractères interdits";
    }
    return false;
  }
}
