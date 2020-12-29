<?php

namespace App;

use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;



class Category extends Model
{

    use \Astrotomic\Translatable\Translatable;
    protected $guarded =[];
    public $translatedAttributes = ['name'];


    function Products(){

        return $this->hasMany(Product::class);
    }
}
