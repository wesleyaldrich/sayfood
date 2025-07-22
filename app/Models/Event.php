<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'location',
        'date',
        'description',
        'image_url',
        'creator_id',
        'status',
        'event_category_id',
        'estimated_participants',
        'organizer_name',
        'organizer_email',
        'organizer_phone',
        'wa_link',
        'supporting_files',
        'duration',
        'start_time',
        'end_time'
    ];



    public function creator()
    {
        return $this->belongsTo(Customer::class, 'creator_id');
    }

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    public function participants()
    {
        // return $this->belongsToMany(Customer::class,'customer_event','customer_id','event_id');
        return $this->belongsToMany(Customer::class, 'customer_event', 'event_id', 'customer_id');
    }
}
