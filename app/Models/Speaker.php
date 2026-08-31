<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Speaker extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'photo', 'job_title', 'company', 'biography',
        'email', 'linkedin', 'website', 'status',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_speaker');
    }
}