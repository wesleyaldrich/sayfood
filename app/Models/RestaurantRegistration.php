<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class RestaurantRegistration extends Model
{
    /** @use HasFactory<\Database\Factories\RestaurantRegistrationFactory> */
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('restaurant_registration')
        ->logOnly(['name', 'address', 'email', 'status'])
        ->logOnlyDirty();
    }

    protected $fillable = [
        'name',
        'address',
        'email'
    ];

    protected $guarded = [
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'id', 'id');
    }
}
