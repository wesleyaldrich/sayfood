<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('customer')
        ->logOnlyDirty();
    }

    protected $fillable = [
        'user_id'
    ];

    public function cart(){
        return $this->hasMany(Cart::class);
    }
 
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function createdEvents()
    {
        return $this->hasMany(Event::class);
    }

    public function joinedEvents()
    {
        return $this->belongsToMany(Event::class, 'customer_event','customer_id','event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function getNameAttribute()
    {
        return $this->user->name ?? 'Anonymous';
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
