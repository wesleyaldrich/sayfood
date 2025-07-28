<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'customer_id',
        'restaurant_id',
        'status',
        'description',
        'note',
        'suspended_restaurant_id'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function suspended_restaurant()
    {
        return $this->belongsTo(SuspendedRestaurant::class);
    }
}
