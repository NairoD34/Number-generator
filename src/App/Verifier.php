<?php

namespace vendor\jdl\App;

final class Verifier
{
  private function __construct()
  {
    //non-instanciable
  }

  /**
   * Checks if the string is a valid date
   * @param string $date : The date to validate
   * @param string $format : The date format (default: 'Y-m-d' = Year-month-day)
   * @return bool : true if the $date is in the correct format
   */
  public static function validateDate(string $date, string $format = 'Y-m-d'): bool
  {
    $d = \DateTime::createFromFormat($format, $date);
    if ($d && $d->format($format) == $date) {
      return true;
    }
    return false;
  }

  /**
   * Checks if the string contains only letters and exceptions passed as paramaters
   * @param string $word : The word/sentence/name to validate
   * @param string $exceptions : A string containing the valid non-letter characters (ex: "_ -")
   * @return bool : true if the $word doesn't have invalid characters
   */
  public static function validateWord(string $word, string $exceptions = ""): bool
  {
    if (preg_match_all("/^[\p{L}\p{M}" . $exceptions . "]*$/mu", $word)) {
      return true;
    }
    return false;
  }
}
