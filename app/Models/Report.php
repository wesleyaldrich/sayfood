<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Report extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('report')
        ->logOnlyDirty();
    }

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
