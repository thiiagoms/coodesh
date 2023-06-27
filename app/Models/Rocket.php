<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Rocket extends Model
{
    use HasUuids;

    protected $table = 'rocket';

    protected $keyType = 'string';

    protected $fillable = [
        'rocket_id',
        'configuration_id',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function launch()
    {
        return $this->belongsTo(Launch::class);
    }

    public function configuration()
    {
        return $this->hasOne(Configuration::class, 'id', 'configuration_id');
    }
}
