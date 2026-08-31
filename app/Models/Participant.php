<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'participant_code', 
        'name', 
        'email', 
        'phone', 
        'event_id',
        'ticket_type', 
        'registration_date', 
        'status',
    ];

    protected $casts = [
        'registration_date' => 'date',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}