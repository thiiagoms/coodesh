<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasUuids;

    protected $table = 'configuration';

    protected $keyType = 'string';

    protected $fillable = [
        'configuration_id',
        'launch_library_id',
        'url',
        'name',
        'family',
        'full_name',
        'variant'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function rocket()
    {
        return $this->belongsTo(Rocket::class);
    }
}
