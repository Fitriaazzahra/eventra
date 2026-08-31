<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'event_code', 'name', 'slug', 'description', 'category_id', 'venue_id',
        'start_date', 'end_date', 'start_time', 'end_time', 'capacity',
        'ticket_price', 'status', 'is_featured', 'cover_image', 'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'ticket_price' => 'decimal:2',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'event_speaker');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}