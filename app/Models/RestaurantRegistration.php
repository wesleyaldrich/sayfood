<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantRegistration extends Model
{
    /** @use HasFactory<\Database\Factories\RestaurantRegistrationFactory> */
    use HasFactory;

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
}
