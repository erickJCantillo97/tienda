<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price'];

    protected $appends = ['stock'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_products');
    }

    public function buy()
    {
        return $this->hasMany(BuyProduct::class);
    }
    public function getStockAttribute()
    {
        return $this->buy->sum('quantity');
    }
}
