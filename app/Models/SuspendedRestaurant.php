<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SuspendedRestaurant extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('suspended_restaurant')
        ->logOnlyDirty();
    }

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
