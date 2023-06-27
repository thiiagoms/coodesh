<?php

namespace App\Models;

use App\Models\Status\Status;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Launch extends Model
{
    use HasUuids;

    protected $table = 'launch';

    protected $keyType = 'string';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'url',
        'launch_library_id',
        'slug',
        'name',
        'status_id',
        'net',
        'window_end',
        'window_start',
        'inhold',
        'tbdtime',
        'tbddate',
        'probability',
        'holdreason',
        'failreason',
        'hashtag',
        'provider_id',
        'rocket_id',
        'mission_id',
        'pad_id',
        'webcast_live',
        'image',
        'infographic',
        'program_id',
        'imported_t'
    ];

    protected $hidden = ['created_at', 'updated_at'];


    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function provider()
    {
        return $this->hasOne(Provider::class, 'id', 'provider_id');
    }

    public function rocket()
    {
        return $this->hasOne(Rocket::class, 'id', 'rocket_id');
    }

    public function mission()
    {
        return $this->hasOne(Mission::class, 'id', 'mission_id');
    }

    public function pad()
    {
        return $this->hasOne(Pad::class, 'id', 'pad_id');
    }
}
