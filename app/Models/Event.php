<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_event');
    }
}
