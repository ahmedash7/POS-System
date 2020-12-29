<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;


class Product extends Model
{
    use \Astrotomic\Translatable\Translatable;
    protected $guarded =[];
    public $translatedAttributes = ['name','description'];
    protected $appends = ['image_path','profit_percent'];

    public  function  getImagePathAttribute(){

        return asset('uploads/product_images/'. $this->image);
    }//end of get last image

    public function getProfitPercentAttribute(){

        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;

        return number_format($profit_percent,2);

    }//end of get last profit
    function Category(){

        return $this->belongsTo(Category::class);
    }

    function orders(){

        return $this->belongsToMany(Order::class , 'product_order');
    }


}
