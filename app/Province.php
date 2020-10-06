<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $guarded = [];
     protected $table = 'province';
      protected $fillable = ['province_id','name'];

     public function city(){
        return $this->hasMany(City::class);
                                        // yg mau diambil , yg mau make
      }
     public function user(){
        return $this->hasMany(User::class);
                                        // yg mau diambil , yg mau make
      }
}
