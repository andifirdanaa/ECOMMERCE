<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttrib extends Model
{
     protected $table = 'product_attrib';
     protected $fillable = ['product_id','sku','size','price','stock'];
     
  
}
