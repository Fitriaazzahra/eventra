<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'label_id',
        'label_en',
        'target_url',
        'is_active',
        'sort_order',
    ];
}
