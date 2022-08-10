<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $table = 'carts';

    protected $fillable=[
        'cart_id',
        'product_id',
        'product_qty',
        'total'
    ];

    public function Products(){
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
