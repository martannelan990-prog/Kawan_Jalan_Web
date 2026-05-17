<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'name',
        'slug',
        'image',
        'description',
        'ticket_price',
        'open_hour',
        'location',
        'is_popular',
        'is_recommended',
        'activity_count',
    ];

    protected $casts = [
        'is_popular' => 'boolean',
        'is_recommended' => 'boolean',
        'activity_count' => 'integer',
        'ticket_price' => 'integer',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
