<?php

namespace App\Libraries;

class Hash
{
  public static function make($password)
  {
    return password_hash($password, PASSWORD_DEFAULT);
  }

  public static function check($password, $db_password)
  {
    if (password_verify($password, $db_password)) {
      return true;
    } else {
      return false;
    }
  }
}
