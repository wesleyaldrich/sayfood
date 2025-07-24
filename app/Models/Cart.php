<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'customer_id',
        'food_id',
        'quantity',
        'notes'
    ];

    public function user(){
        return $this->belongsTo(Customer::class);
    }

    public function food(){
        return $this->belongsTo(Food::class);
    }
}
