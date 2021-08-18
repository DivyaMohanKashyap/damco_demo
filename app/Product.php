<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'category_id',
        'price',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
