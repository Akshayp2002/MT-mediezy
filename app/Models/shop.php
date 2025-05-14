<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shop extends Model
{
    protected $fillable = ['name', 'address', 'user_id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_shops');
    }
}

