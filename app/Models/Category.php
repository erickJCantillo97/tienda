<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $appends = ['count_products'];
    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'categories_products');
    }


    public function getCountProductsAttribute()
    {
        return $this->products->count();
    }
}
