<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'status'
    ];

    public function customer()
    {
       return $this->belongsTo(Customer::class); 
    }

    public function restaurant()
    {
       return $this->belongsTo(Restaurant::class); 
    }
}
