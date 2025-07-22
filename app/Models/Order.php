<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('order')
        ->logOnly(['customer_id', 'restaurant_id', 'status'])
        ->logOnlyDirty();
    }

    protected $fillable = [
        'customer_id',
        'restaurant_id'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function getTotalPriceAttribute()
    {
        return $this->transactions()
            ->join('foods', 'transactions.food_id', '=', 'foods.id')
            ->selectRaw('SUM(foods.price * transactions.qty) as total')
            ->value('total');
    }
}
