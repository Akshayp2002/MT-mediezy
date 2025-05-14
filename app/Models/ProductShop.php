<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductShop extends Model
{
    protected $table = 'product_shops';

    protected $fillable = [
        'product_id',
        'shop_id',
        'status',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
