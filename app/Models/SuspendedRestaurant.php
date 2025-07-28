<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuspendedRestaurant extends Model
{
    protected $fillable = [
        'id',
        'name',
        'email',
        'address',
        'description',
        'image_url_resto',
    ];

    public function report()
    {
        return $this->hasMany(Report::class);
    }

}
