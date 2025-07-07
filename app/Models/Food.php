<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';
    protected $casts = [
    'exp_datetime' => 'datetime'
    ];

    protected $fillable = [
        'restaurant_id',
        'name',
        'category_id',
        'description',
        'exp_datetime',
        'stock',
        'status'
    ];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }
}
