<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_email',
        'user_id',
    ];
    protected $appends = ['total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(SaleProduct::class);
    }

    public function getTotalAttribute()
    {
        return $this->products->sum('total');
    }
}
