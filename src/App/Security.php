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

  // Renvoie 
  public static function hasHTMLShit(string $check):bool
  {
    if (htmlspecialchars($check) !== $check) {
      return true;
    }
    return false;
  }
}