<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pad extends Model
{
    use HasUuids;

    protected $table = 'pad';

    protected $keyType = 'string';

    protected $fillable = [
        'pad_id',
        'url',
        'agency_id',
        'name',
        'info_url',
        'wiki_url',
        'map_url',
        'latitude',
        'longitude',
        'location_id',
        'map_image',
        'total_launch_count'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function launch()
    {
        return $this->belongsTo(Launch::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }
}
