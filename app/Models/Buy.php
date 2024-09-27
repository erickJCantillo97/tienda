<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_name',
        'supplier_email',
        'user_id',
    ];

    protected $appends = ['total'];

    public function products()
    {
        return $this->hasMany(BuyProduct::class);
    }

    public function getTotalAttribute()
    {
        return $this->products->sum('total');
    }
}
