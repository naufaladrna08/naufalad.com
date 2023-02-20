<?php 

namespace App\Classes;

class Helpers {
  public static function timeElapsedString($datetime, $maxhour = 24 * 7, $full = false) {
    $now = new \DateTime();
    $ago = new \DateTime($datetime);

    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;


    if ($maxhour != 0 and $diff->h > $maxhour) {
      return $datetime;
    }

    // if ($diff->d > 1) {
    //   return self::convertTglIndo($datetime);
    // }

    $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hours',
      'i' => 'minute',
      's' => 'second',
    );

    foreach ($string as $k => &$v) {
      if ($diff->$k) {
        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
      } else {
        unset($string[$k]);
      }
    }

    if (!$full) $string = array_slice($string, 0, 1);

    return $string ? implode(', ', $string) . ' ago' : 'just now';
  }

}