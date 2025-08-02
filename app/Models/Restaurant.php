<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Restaurant extends Model
{
    /** @use HasFactory<\Database\Factories\RestaurantFactory> */
    use HasFactory, SoftDeletes, LogsActivity;

    protected static function booted()
    {
        static::deleting(function ($restaurant) {
            if (!$restaurant->isForceDeleting()) {
                $restaurant->foods()->delete();
            }
        });
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('restaurant')
        ->logOnlyDirty();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'address',
        'user_id',
        'image_url_resto'
    ];
    /**
     * The attributes that aren't mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    /**
     * Get the user that owns the restaurant.
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function registration()
    {
        return $this->hasOne(RestaurantRegistration::class);
    }

    public function getTotalDonationAttribute()
    {
        return $this->orders()
            ->join('transactions', 'transactions.order_id', '=', 'orders.id')
            ->join('foods', 'transactions.food_id', '=', 'foods.id')
            ->selectRaw('SUM(foods.price * transactions.qty) as total')
            ->whereIn('orders.status', ['Order Completed', 'Order Reviewed'])
            ->value('total');
    }

    public function getTotalOrdersAttribute()
    {
        return $this->orders()
            ->whereIn('status', ['Order Completed', 'Order Reviewed'])
            ->count();
    }


    public function getAvgRatingAttribute()
    {
        return $this->orders()
            ->whereNotNull('rating')
            ->avg('rating');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

}
