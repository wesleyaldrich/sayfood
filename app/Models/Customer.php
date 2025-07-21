<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id'
    ];
    
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function events(){
        return $this->hasMany(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
                            
}
