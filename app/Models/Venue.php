<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'address', 'city', 'province', 'postal_code',
        'capacity', 'description', 'latitude', 'longitude', 'status',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}