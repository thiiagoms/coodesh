<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasUuids;

    protected $table = 'location';

    protected $keyType = 'string';

    protected $fillable = [
        'location_id',
        'url',
        'name',
        'country_code',
        'map_image',
        'total_launch_count',
        'total_landing_count',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
