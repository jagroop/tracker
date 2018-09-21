<?php
namespace App\Helpers;

class Tracker
{

  public static function sanitizeKeyword($keyword, $limit = false)
  {
      $result = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $keyword)));
      if($limit !== false && $limit > 0) {
        return str_limit($result, $limit, '...');
      }
      return $result;
  }

  public static function stringToArray($string)
  {
      $clean = self::sanitizeKeyword($string);
      return explode(' ', $clean);
  }
}