<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Food extends Model
{
    use SoftDeletes, LogsActivity;

    protected static function booted()
    {
        static::deleting(function ($food) {
            if (!$food->isForceDeleting()) {
                $food->cart()->delete();
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('food')
        ->logOnlyDirty();
    }

    protected $table = 'foods';
    protected $casts = [
        'exp_datetime' => 'datetime'
    ];

    protected $fillable = [
        'restaurant_id',
        'name',
        'category_id',
        'description',
        'exp_datetime',
        'stock',
        'image_url',
        'status',
        'price'
    ];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class)->withTrashed();
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}


