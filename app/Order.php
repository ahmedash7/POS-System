<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function client() {

        return $this->belongsTo(Client::class);
    } // end of user

    function product(){

        return $this->belongsToMany(Product::class , 'product_order')->withPivot('quantity');
    }
}
