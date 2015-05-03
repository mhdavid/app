<?php namespace App\Models;

use Jazz\Model as BaseModel;

class Mock extends BaseModel
{
  static function getUsersOnline()
  {
    return [
      'Adriel Vieira',
      'Márcio H. David'
    ];
  }
}