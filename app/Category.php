<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'product_id'];


    /**
     * Get the product that owns the category.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
