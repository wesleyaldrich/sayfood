<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuspendedRestaurant extends Model
{
    use SoftDeletes;

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
