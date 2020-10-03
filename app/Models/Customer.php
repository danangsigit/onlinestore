<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
  use Notifiable;
  protected $guarded = [];

  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = bcrypt($value);
  }
}
