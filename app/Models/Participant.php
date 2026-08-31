<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Hapus import SoftDeletes di sini

class Participant extends Model
{
    use HasFactory; // Hapus SoftDeletes di sini

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