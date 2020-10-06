<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'Categorys';
    protected $fillable = ['id_category','name_category','url','description'];

    public function product() {
        return $this->hasMany(Product::class);
    }
}
