<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_event','event_id','customer_id');
    }

    public function creator()
    {
        return $this->belongsTo(Customer::class, 'creator_id');
    }

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    public function participants(){
        return $this->belongsToMany(Customer::class,'customer_event','event_id','customer_id')->withPivot('phone_number');
    }
}
