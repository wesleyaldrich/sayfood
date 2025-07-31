<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Cart extends Model
{
    use SoftDeletes, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('cart')
        ->logOnlyDirty();
    }

    protected $fillable = [
        'customer_id',
        'food_id',
        'quantity',
        'notes'
    ];

    public function user(){
        return $this->belongsTo(Customer::class);
    }

    public function food(){
        return $this->belongsTo(Food::class);
    }
}
