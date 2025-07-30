<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;
    // protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('event')
        ->logOnlyDirty();
    }
    
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_event','event_id','customer_id');
    }

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
        'group_link',
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

    public function participants(){
        return $this->belongsToMany(Customer::class,'customer_event','event_id','customer_id')->withPivot('phone_number');
    }
}
