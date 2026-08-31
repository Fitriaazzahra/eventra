<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteAboutSetting extends Model
{
    use HasFactory;

    protected $table = 'site_about_settings';

    protected $fillable = [
        'key',
        'value_id',
        'value_en',
        'sort_order',
    ];
}
