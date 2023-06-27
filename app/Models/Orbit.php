<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Orbit extends Model
{
    use HasUuids;

    protected $table = 'orbit';

    protected $keyType = 'string';

    protected $fillable = [
        'orbit_id',
        'name',
        'abbrev'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
