<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
      protected $guarded = [];
      protected $table = 'couriers';
      protected $fillable = ['id','code','name'];
}
