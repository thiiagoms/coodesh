<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasUuids;

    protected $table = 'mission';

    protected $keyType = 'string';

    protected $fillable = [
        'mission_id',
        'launch_library_id',
        'orbit_id',
        'name',
        'description',
        'launch_designator',
        'type'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function launch()
    {
        return $this->belongsTo(Launch::class);
    }

    public function orbit()
    {
        return $this->hasOne(Orbit::class, 'id', 'orbit_it');
    }
}
